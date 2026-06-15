<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\PortfolioCategory;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;

class ShehalaPortfolioSeeder extends Seeder
{
    public function run()
    {
        // Smart Check: If portfolios already exist, skip to save time and prevent duplicate entries
        if (PortfolioCategory::count() > 0 || Portfolio::count() > 0) {
            $this->command->info('Portfolios and Categories are already seeded. Skipping ShehalaPortfolioSeeder...');
            return;
        }

        // Create upload directory if it doesn't exist
        $uploadPath = public_path('uploads/portfolios');
        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true);
        }

        $this->command->info("Fetching portfolio page...");
        
        try {
            $response = Http::withOptions(['verify' => false])->get('https://shehala.com/portfolio');
            $html = $response->body();
            
            libxml_use_internal_errors(true);
            $dom = new \DOMDocument();
            $dom->loadHTML($html);
            libxml_clear_errors();
            $xpath = new \DOMXPath($dom);

            // Fetch and create Categories
            $categoryNodes = $xpath->query('//ul[contains(@class, "tabs")]/li/a');
            $categoriesMap = [];
            foreach ($categoryNodes as $node) {
                $catName = trim($node->textContent);
                if ($catName && strtolower($catName) !== 'all') {
                    $cat = PortfolioCategory::firstOrCreate(
                        ['slug' => Str::slug($catName)],
                        ['name' => $catName, 'status' => 1]
                    );
                    $categoriesMap[strtolower($catName)] = $cat->id;
                    $this->command->line("Found Category: " . $catName);
                }
            }

            // Fallback General Category
            $defaultCat = PortfolioCategory::firstOrCreate(['slug' => 'general'], ['name' => 'General', 'status' => 1]);

            // Fetch Portfolio Items
            $portfolioNodes = $xpath->query('//div[contains(@class, "featured-imagebox-portfolio")]');
            $count = 0;

            foreach ($portfolioNodes as $itemNode) {
                // Extract Image
                $imgNode = $xpath->query('.//img', $itemNode)->item(0);
                $titleNode = $xpath->query('.//div[contains(@class, "featured-title")]//a', $itemNode)->item(0);
                $catNode = $xpath->query('.//div[contains(@class, "category")]//p', $itemNode)->item(0);

                if ($imgNode && $titleNode) {
                    $src = $imgNode->getAttribute('src');
                    $title = trim($titleNode->textContent);
                    $link = $titleNode->getAttribute('href');
                    $catText = $catNode ? trim($catNode->textContent) : 'General';
                    
                    $categoryId = $categoriesMap[strtolower($catText)] ?? $defaultCat->id;

                    // Fix Image URL (e.g. "../images/..." to "https://shehala.com/images/...")
                    if (str_starts_with($src, '../')) {
                        $src = 'https://shehala.com/' . substr($src, 3);
                    } elseif (!str_starts_with($src, 'http')) {
                        $src = 'https://shehala.com' . (str_starts_with($src, '/') ? '' : '/') . $src;
                    }

                    $this->command->line("  Downloading image for: $title");
                    
                    try {
                        $imgContents = @file_get_contents($src);
                        if ($imgContents) {
                            $ext = pathinfo(parse_url($src, PHP_URL_PATH), PATHINFO_EXTENSION);
                            if (empty($ext) || strlen($ext) > 4) $ext = 'jpg';
                            
                            $slug = Str::slug($title) ?: 'portfolio-' . uniqid();
                            $imgName = $slug . '-' . time() . '.' . $ext;
                            
                            File::put(public_path('uploads/portfolios/' . $imgName), $imgContents);
                            $imagePath = 'uploads/portfolios/' . $imgName;

                            // Insert into DB
                            Portfolio::firstOrCreate([
                                'slug' => $slug,
                            ], [
                                'portfolio_category_id' => $categoryId,
                                'title' => $title,
                                'image' => $imagePath,
                                'website_url' => $link,
                                'status' => 1,
                                'description' => '<p>Portfolio project for ' . $title . '</p>'
                            ]);
                            
                            $count++;
                        }
                    } catch (\Exception $e) {
                        $this->command->warn("    Failed to download image: $src");
                    }
                }
            }
            
            if ($count == 0) {
                $this->command->warn('No portfolio items found. Make sure the structure matches.');
            } else {
                $this->command->info("Successfully scraped and inserted $count portfolio items!");
            }

        } catch (\Exception $e) {
            $this->command->error("Error scraping portfolio: " . $e->getMessage());
        }
    }
}
