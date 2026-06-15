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
            $response = Http::withOptions(['verify' => false])->get('https://www.shehala.com/portfolio');
            $html = $response->body();
            
            libxml_use_internal_errors(true);
            $dom = new \DOMDocument();
            $dom->loadHTML($html);
            libxml_clear_errors();
            $xpath = new \DOMXPath($dom);

            // Let's scrape categories first if they have filters (like .portfolio-filter li a)
            // But usually, they are just items. We can create a default category if none found.
            $defaultCategory = PortfolioCategory::firstOrCreate([
                'slug' => 'general'
            ], [
                'name' => 'General Portfolio',
                'status' => 1
            ]);

            // Try to find portfolio items. Shehala IT uses ttm-box-view-overlay or similar classes.
            // We look for any image inside a portfolio section, or just any link with an image inside a grid.
            $portfolioNodes = $xpath->query('//div[contains(@class, "ttm-box-view-content-inner") or contains(@class, "portfolio")]//img');
            
            // If the specific class fails, fallback to images inside links in a grid.
            if ($portfolioNodes->length === 0) {
                $portfolioNodes = $xpath->query('//div[contains(@class, "row") or contains(@class, "grid")]//img');
            }

            $count = 0;

            foreach ($portfolioNodes as $imgNode) {
                $src = $imgNode->getAttribute('src');
                $alt = $imgNode->getAttribute('alt') ?: 'Portfolio Item ' . ($count + 1);
                
                // If the src is valid and looks like a portfolio image
                if (!empty($src) && !str_contains($src, 'logo')) {
                    if (!str_starts_with($src, 'http')) {
                        $src = 'https://www.shehala.com' . (str_starts_with($src, '/') ? '' : '/') . $src;
                    }
                    
                    $this->command->line("  Downloading image: $src");
                    
                    try {
                        $imgContents = @file_get_contents($src);
                        if ($imgContents) {
                            $ext = pathinfo(parse_url($src, PHP_URL_PATH), PATHINFO_EXTENSION);
                            if (empty($ext) || strlen($ext) > 4) $ext = 'jpg';
                            
                            $slug = Str::slug($alt) ?: 'portfolio-' . uniqid();
                            $imgName = $slug . '-' . time() . '.' . $ext;
                            
                            File::put(public_path('uploads/portfolios/' . $imgName), $imgContents);
                            $imagePath = 'uploads/portfolios/' . $imgName;

                            Portfolio::firstOrCreate([
                                'slug' => $slug,
                            ], [
                                'portfolio_category_id' => $defaultCategory->id,
                                'title' => $alt,
                                'image' => $imagePath,
                                'status' => 1,
                                'description' => '<p>Portfolio project for ' . $alt . '</p>'
                            ]);
                            
                            $count++;
                        }
                    } catch (\Exception $e) {
                        $this->command->warn("    Failed to download image: $src");
                    }
                }
                
                // Limit to 20 items to not overload the server
                if ($count >= 20) {
                    break;
                }
            }
            
            if ($count == 0) {
                $this->command->warn('No portfolio items found to scrape. Inserting dummy data.');
                $this->insertDummyData($defaultCategory);
            } else {
                $this->command->info("Successfully scraped and inserted $count portfolio items!");
            }

        } catch (\Exception $e) {
            $this->command->error("Error scraping portfolio: " . $e->getMessage());
            // Fallback to dummy data
            $defaultCategory = PortfolioCategory::firstOrCreate(['slug' => 'general'], ['name' => 'General', 'status' => 1]);
            $this->insertDummyData($defaultCategory);
        }
    }

    private function insertDummyData($category)
    {
        $dummyItems = [
            'E-commerce Website Design',
            'Corporate Business Portal',
            'Restaurant Web Application',
            'Real Estate Platform'
        ];

        foreach ($dummyItems as $item) {
            Portfolio::firstOrCreate([
                'slug' => Str::slug($item)
            ], [
                'portfolio_category_id' => $category->id,
                'title' => $item,
                'status' => 1,
                'description' => '<p>This is a sample description for ' . $item . '.</p>'
            ]);
        }
    }
}
