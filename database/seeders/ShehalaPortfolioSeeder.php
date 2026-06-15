<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\PortfolioCategory;
use App\Models\Portfolio;
use Illuminate\Support\Facades\File;

class ShehalaPortfolioSeeder extends Seeder
{
    public function run()
    {
        // Smart Check: Prevent duplicate entries
        if (PortfolioCategory::count() > 0 || Portfolio::count() > 0) {
            $this->command->info('Portfolios and Categories are already seeded. Skipping ShehalaPortfolioSeeder...');
            return;
        }

        // Create upload directory if it doesn't exist
        $uploadPath = public_path('uploads/portfolios');
        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true);
        }

        $this->command->info("Seeding Shehala Portfolio Data...");

        $items = [
            ["category" => "WordPress", "title" => "Borsting Consult", "image" => "https://shehala.com/images/portfolio-images/WMLvf5akTtyuOcLjWfQj.jpg", "website_url" => "https://shehala.com/portfolio-details/1/1"],
            ["category" => "WordPress", "title" => "Party FYN", "image" => "https://shehala.com/images/portfolio-images/rE3EN50xN3QQTUTz77Kp.jpg", "website_url" => "https://shehala.com/portfolio-details/2/1"],
            ["category" => "WordPress", "title" => "Pay Back", "image" => "https://shehala.com/images/portfolio-images/ghuOHdjCdnmz3UvmN9Ny.jpg", "website_url" => "https://shehala.com/portfolio-details/3/1"],
            ["category" => "WordPress", "title" => "London Bar", "image" => "https://shehala.com/images/portfolio-images/wZ8sWbC9PzVwZp7v66n7.jpg", "website_url" => "https://shehala.com/portfolio-details/4/1"],
            ["category" => "WordPress", "title" => "Esbjerg Skojteklub", "image" => "https://shehala.com/images/portfolio-images/m7g9rC6H6oZ1U2xN0aD5.jpg", "website_url" => "https://shehala.com/portfolio-details/5/1"],
            ["category" => "WordPress", "title" => "Århus Håndbold", "image" => "https://shehala.com/images/portfolio-images/YhDqWp6qU5s5b0K3L7A2.png", "website_url" => "https://shehala.com/portfolio-details/6/1"],
            ["category" => "WordPress", "title" => "Wega Vinduer", "image" => "https://shehala.com/images/portfolio-images/l4Q9L7y1q1C4t7zN4L9f.jpg", "website_url" => "https://shehala.com/portfolio-details/7/1"],
            ["category" => "WordPress", "title" => "Energiraadet", "image" => "https://shehala.com/images/portfolio-images/a6B1hV7xX1g1P6E9mR8o.jpg", "website_url" => "https://shehala.com/portfolio-details/8/1"],
            ["category" => "WordPress", "title" => "Art", "image" => "https://shehala.com/images/portfolio-images/eH5T9l4F1q8hT7kX9J3e.jpg", "website_url" => "https://shehala.com/portfolio-details/9/1"],
            ["category" => "WordPress", "title" => "Owo dk", "image" => "https://shehala.com/images/portfolio-images/X3wK1z2F1m6A3B9Y1P0q.jpg", "website_url" => "https://shehala.com/portfolio-details/10/1"],
            ["category" => "WordPress", "title" => "Penta Advokater", "image" => "https://shehala.com/images/portfolio-images/7B1Q7G8M1H1F7t7W4E5a.jpg", "website_url" => "https://shehala.com/portfolio-details/11/1"],
            ["category" => "WordPress", "title" => "Gulvcenter", "image" => "https://shehala.com/images/portfolio-images/K6g2K5aZ3m7cZ5Z1eA7u.jpg", "website_url" => "https://shehala.com/portfolio-details/12/1"],
            ["category" => "WordPress", "title" => "Oxeogco", "image" => "https://shehala.com/images/portfolio-images/5Kdu8PkhDLGfHZi565ZR.jpg", "website_url" => "https://shehala.com/portfolio-details/21/1"],
            ["category" => "Joomla", "title" => "Alt om Håndarbejde", "image" => "https://shehala.com/images/portfolio-images/afewzMeooebg9nX3IVXZ.jpg", "website_url" => "https://shehala.com/portfolio-details/13/2"],
            ["category" => "Joomla", "title" => "Allt om handarbete", "image" => "https://shehala.com/images/portfolio-images/Ld8r6TL3KDgDPBlc4HOt.jpg", "website_url" => "https://shehala.com/portfolio-details/14/2"],
            ["category" => "Joomla", "title" => "Alt om Håndarbeide Norwegian", "image" => "https://shehala.com/images/portfolio-images/LZ8huqzTiuS14CncW7GU.jpg", "website_url" => "https://shehala.com/portfolio-details/15/2"],
            ["category" => "Joomla", "title" => "ProTruck A/S", "image" => "https://shehala.com/images/portfolio-images/wJguL4GbKmXFomBGVd5x.jpg", "website_url" => "https://shehala.com/portfolio-details/16/2"],
            ["category" => "Joomla", "title" => "Jaguar | THE ART", "image" => "https://shehala.com/images/portfolio-images/ggvt2ZRLxfTMmnnSDJ1s.png", "website_url" => "https://shehala.com/portfolio-details/17/2"],
            ["category" => "Joomla", "title" => "Fisker Automotive", "image" => "https://shehala.com/images/portfolio-images/RTxdlN6q9zF8q1wvhjnW.jpg", "website_url" => "https://shehala.com/portfolio-details/18/2"],
            ["category" => "Joomla", "title" => "Goalkeeper Academy", "image" => "https://shehala.com/images/portfolio-images/M72wLndKoxu6sPYg6XeG.jpg", "website_url" => "https://shehala.com/portfolio-details/19/2"],
            ["category" => "Joomla", "title" => "High Commission for Bangladesh, Canada", "image" => "https://shehala.com/images/portfolio-images/wV7eRjf56fgqBYT8dgRn.jpg", "website_url" => "https://shehala.com/portfolio-details/20/2"],
            ["category" => "Joomla", "title" => "Telt Serviceudlejning", "image" => "https://shehala.com/images/portfolio-images/y5GNzEdI3OycGSmvOPM5.jpg", "website_url" => "https://shehala.com/portfolio-details/22/2"],
            ["category" => "Joomla", "title" => "Al Ummah", "image" => "https://shehala.com/images/portfolio-images/0qTmbDz7lMydBccYMn3S.jpg", "website_url" => "https://shehala.com/portfolio-details/23/2"],
            ["category" => "3D Services", "title" => "Divider", "image" => "https://shehala.com/images/portfolio-images/2SC6qwIRc7mX6zKYKIdz.jpg", "website_url": "https://shehala.com/portfolio-details/24/11"],
            ["category" => "3D Services", "title" => "Four Room Divider Large and Small", "image" => "https://shehala.com/images/portfolio-images/dnRCCc4w3z4QR9aOAZE9.jpg", "website_url": "https://shehala.com/portfolio-details/25/11"],
            ["category" => "3D Services", "title" => "Chair", "image" => "https://shehala.com/images/portfolio-images/3kMPM0BuBMW6y64Pomd5.jpg", "website_url": "https://shehala.com/portfolio-details/26/11"],
            ["category" => "3D Services", "title": "Sofa", "image" => "https://shehala.com/images/portfolio-images/bqDvPf27lfyo6B1q6lCU.jpg", "website_url": "https://shehala.com/portfolio-details/27/11"],
            ["category" => "3D Services", "title" => "Lima Centre, Left and Right Corner, Ottoman Unit", "image" => "https://shehala.com/images/portfolio-images/UoTYkFI9vsVhtCz68GjI.jpg", "website_url": "https://shehala.com/portfolio-details/28/11"],
            ["category" => "3D Services", "title" => "Quadro", "image" => "https://shehala.com/images/portfolio-images/pzPepz1c2P0zhKOSxglV.jpg", "website_url": "https://shehala.com/portfolio-details/29/11"],
            ["category" => "3D Services", "title" => "Oven", "image" => "https://shehala.com/images/portfolio-images/t6z2QwJdZyENnbkmELIi.jpg", "website_url": "https://shehala.com/portfolio-details/30/11"],
            ["category" => "3D Services", "title" => "Kitchen Hood", "image" => "https://shehala.com/images/portfolio-images/d3vv16gSS002hL2avoU7.jpg", "website_url": "https://shehala.com/portfolio-details/31/11"],
            ["category" => "3D Services", "title" => "Pendent", "image" => "https://shehala.com/images/portfolio-images/OE6CUe73yKq78QYhP6KO.jpg", "website_url": "https://shehala.com/portfolio-details/32/11"],
            ["category" => "Magazine Design", "title" => "Burda Plus", "image" => "https://shehala.com/images/portfolio-images/3NdH5ewvzmYdRvPiEHLX.jpg", "website_url": "https://shehala.com/portfolio-details/33/13"],
            ["category" => "Magazine Design", "title" => "Burda Style", "image" => "https://shehala.com/images/portfolio-images/piQ1zfM7onZ3ClcGxRHr.jpg", "website_url": "https://shehala.com/portfolio-details/34/13"],
            ["category" => "Magazine Design", "title" => "Burda Easy", "image" => "https://shehala.com/images/portfolio-images/DAgbG2nnb33NRIBWA4oY.jpg", "website_url": "https://shehala.com/portfolio-details/35/13"],
            ["category" => "Magazine Design", "title" => "Kreative Strik", "image" => "https://shehala.com/images/portfolio-images/pHNfWcoW34MNiIUWSdXe.jpg", "website_url": "https://shehala.com/portfolio-details/36/13"],
            ["category" => "Magazine Design", "title" => "Strikke Magasin", "image" => "https://shehala.com/images/portfolio-images/x6s5yek268d0Q3hMR8Ql.jpg", "website_url": "https://shehala.com/portfolio-details/37/13"],
            ["category" => "Magazine Design", "title" => "SY Magasin", "image" => "https://shehala.com/images/portfolio-images/6yCs53HoGlDNDb8T3X8e.jpg", "website_url": "https://shehala.com/portfolio-details/38/13"],
            ["category" => "Newspaper Add", "title" => "Newspaper Add", "image" => "https://shehala.com/images/portfolio-images/PAIsGUEnKWC1zNCEXzFN.jpg", "website_url": "https://shehala.com/portfolio-details/39/14"],
            ["category" => "Newspaper Add", "title" => "Newspaper Advertisement", "image" => "https://shehala.com/images/portfolio-images/lnM3HljjxhgEosm2is29.jpg", "website_url": "https://shehala.com/portfolio-details/40/14"],
            ["category" => "Newspaper Add", "title" => "Newspaper Advertisement", "image" => "https://shehala.com/images/portfolio-images/60cYqAIQ3IK1vkRB2Oju.jpg", "website_url": "https://shehala.com/portfolio-details/41/14"],
            ["category" => "Newspaper Add", "title" => "Newspaper Advertisement", "image" => "https://shehala.com/images/portfolio-images/pXkouusStxsBodnVRy5j.jpg", "website_url": "https://shehala.com/portfolio-details/42/14"],
            ["category" => "Newspaper Add", "title" => "Newspaper Advertisement", "image" => "https://shehala.com/images/portfolio-images/rVxGTzMoYD35tg5Accyf.jpg", "website_url": "https://shehala.com/portfolio-details/43/14"],
            ["category" => "Newspaper Add", "title" => "Newspaper Advertisement", "image" => "https://shehala.com/images/portfolio-images/rMFYrXw99HFuZwbj3eeN.jpg", "website_url": "https://shehala.com/portfolio-details/44/14"]
        ];

        $categoriesMap = [];

        foreach ($items as $item) {
            // Create Category (Smartly)
            if (!isset($categoriesMap[$item['category']])) {
                $cat = PortfolioCategory::firstOrCreate(
                    ['slug' => Str::slug($item['category'])],
                    ['name' => $item['category'], 'status' => 1]
                );
                $categoriesMap[$item['category']] = $cat->id;
            }

            $categoryId = $categoriesMap[$item['category']];
            $slug = Str::slug($item['title']) ?: 'portfolio-' . uniqid();
            
            // Generate Local Image Name
            $ext = pathinfo(parse_url($item['image'], PHP_URL_PATH), PATHINFO_EXTENSION);
            if (empty($ext) || strlen($ext) > 4) $ext = 'jpg';
            $imgName = Str::slug($item['title']) . '-' . md5($item['image']) . '.' . $ext;
            $imagePath = 'uploads/portfolios/' . $imgName;

            // Only Download if we don't have it in the DB already (Extra smart)
            if (!Portfolio::where('website_url', $item['website_url'])->exists()) {
                
                $this->command->line("  Downloading image: {$item['image']}");
                
                try {
                    $imgContents = @file_get_contents($item['image']);
                    if ($imgContents) {
                        File::put(public_path($imagePath), $imgContents);
                        
                        // Create Portfolio item
                        Portfolio::firstOrCreate(
                            ['website_url' => $item['website_url']], // Unique Identifier
                            [
                                'slug' => $slug,
                                'portfolio_category_id' => $categoryId,
                                'title' => $item['title'],
                                'image' => $imagePath,
                                'status' => 1,
                                'description' => '<p>Details for ' . $item['title'] . '</p>'
                            ]
                        );
                    }
                } catch (\Exception $e) {
                    $this->command->warn("    Failed to download image: {$item['image']}");
                }
                
                // Slight delay to prevent hammering the source server
                usleep(500000); 
            }
        }

        $this->command->info("Successfully seeded all portfolio items!");
    }
}
