<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\ServiceCategory;
use App\Models\Service;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;

class ShehalaServiceSeeder extends Seeder
{
    public function run()
    {
        // Smart Check: If services already exist, skip to save time and prevent duplicate scraping
        if (ServiceCategory::count() > 0 || Service::count() > 0) {
            $this->command->info('Services and Categories are already seeded. Skipping ShehalaServiceSeeder...');
            return;
        }

        // Create upload directory if it doesn't exist
        $uploadPath = public_path('uploads/services');
        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true);
        }

        $categories = [
            [
                'name' => 'Web Development',
                'icon' => 'flaticon-developer',
                'description' => 'Global Graphic Giant Ltd. offers custom web application development on various technologies.',
                'children' => [
                    ['name' => 'Web Application', 'url' => 'https://www.shehala.com/web-application-development'],
                    ['name' => 'Digital Catalog System', 'url' => 'https://www.shehala.com/digital-catalog-system'],
                    ['name' => 'CMS Banner System', 'url' => 'https://www.shehala.com/cms-banner-system'],
                    ['name' => 'Content Management System', 'url' => 'https://www.shehala.com/content-management-system'],
                    ['name' => 'Website Maintenance', 'url' => 'https://www.shehala.com/website-maintenance'],
                    ['name' => 'Banner Order System', 'url' => 'https://www.shehala.com/banner-order-system'],
                ]
            ],
            [
                'name' => 'Website Design',
                'icon' => 'flaticon-code',
                'description' => 'Web Design is essential to provide a user friendly experience for all users across all platforms.',
                'children' => [
                    ['name' => 'Responsive Web Design', 'url' => 'https://www.shehala.com/responsive-web-design'],
                    ['name' => 'Logo Design', 'url' => 'https://www.shehala.com/logo-design'],
                    ['name' => 'PSD to XHTML/CSS3', 'url' => 'https://www.shehala.com/psdto-html5'],
                    ['name' => 'PSD Design', 'url' => 'https://www.shehala.com/psd-design'],
                ]
            ],
            [
                'name' => 'Ecommerce Development',
                'icon' => 'flaticon-report',
                'description' => 'Ecommerce development platforms to lunch a modern website. We provide skillful experts.',
                'children' => [
                    ['name' => 'WordPress WooCommerce', 'url' => 'https://www.shehala.com/wordpress-woocommerce'],
                    ['name' => 'Joomla VirtueMart', 'url' => 'https://www.shehala.com/joomla-virtueMart'],
                    ['name' => 'Magento Ecommerce', 'url' => 'https://www.shehala.com/magento-ecommerce'],
                    ['name' => 'Opencart Ecommerce', 'url' => 'https://www.shehala.com/opencart-ecommerce'],
                ]
            ],
            [
                'name' => 'Payment Getway Solutions',
                'icon' => 'flaticon-wallet',
                'description' => 'Integrate leading payment gateways for secure transactions.',
                'children' => [
                    ['name' => 'Paypal Integration', 'url' => 'https://www.shehala.com/paypal-integration'],
                    ['name' => 'DIBS Integration', 'url' => 'https://www.shehala.com/DIBS-integration'],
                    ['name' => 'Local Payment Getway', 'url' => 'https://www.shehala.com/local-payment-getway-integration'],
                ]
            ],
            [
                'name' => 'CMS Extensions',
                'icon' => 'flaticon-puzzle',
                'description' => 'Custom plugin, module, and component development for CMS platforms.',
                'children' => [
                    ['name' => 'WordPress Plugin', 'url' => 'https://www.shehala.com/wordpress-plugin-development'],
                    ['name' => 'Joomla Module', 'url' => 'https://www.shehala.com/joomla-module-development'],
                    ['name' => 'Joomla Plugin', 'url' => 'https://www.shehala.com/joomla-plugin-development'],
                    ['name' => 'Joomla Component', 'url' => 'https://www.shehala.com/joomla-component-development'],
                ]
            ],
            [
                'name' => 'Banner Production',
                'icon' => 'flaticon-report',
                'description' => 'Our expert Graphics Designer can create elegant, simple, clean & eye-catching Banner or Slider.',
                'children' => [
                    ['name' => 'Banner Design', 'url' => 'https://www.shehala.com/banner-design'],
                    ['name' => 'HTML5 Banner', 'url' => 'https://www.shehala.com/html5-banner-development'],
                    ['name' => 'CMS Banner', 'url' => 'https://www.shehala.com/cms-banner-development'],
                    ['name' => 'Flash Banner', 'url' => 'https://www.shehala.com/flash-banner-development'],
                    ['name' => 'GIF Banner', 'url' => 'https://www.shehala.com/gif-banner-development'],
                    ['name' => 'Static Banner', 'url' => 'https://www.shehala.com/static-banner-development'],
                ]
            ],
            [
                'name' => '3D Production',
                'icon' => 'flaticon-3d',
                'description' => '3D Modeling and AR/VR Model Visualization.',
                'children' => [
                    ['name' => '3D Model', 'url' => 'https://www.shehala.com/3D-production'],
                    ['name' => '3D & AR/VR Model Visualization', 'url' => 'https://www.shehala.com/ar-model-visualization'],
                ]
            ],
            [
                'name' => 'Image Production',
                'icon' => 'flaticon-computer',
                'description' => 'Global Graphic Giant is one of the most fascinating images editing service provider.',
                'children' => [
                    ['name' => 'Clipping Path', 'url' => 'https://www.shehala.com/clipping-path'],
                    ['name' => 'Element Masking', 'url' => 'https://www.shehala.com/multi-layer-clipping-element-masking'],
                    ['name' => 'Image Manipulation', 'url' => 'https://www.shehala.com/image-manipulation'],
                ]
            ]
        ];

        foreach ($categories as $catData) {
            $this->command->info("Processing Category: {$catData['name']}");
            
            $parent = ServiceCategory::create([
                'name' => $catData['name'],
                'slug' => Str::slug($catData['name']),
                'icon' => $catData['icon'],
                'description' => $catData['description'],
                'status' => 1
            ]);

            foreach ($catData['children'] as $childData) {
                $this->command->line("  Scraping Service: {$childData['name']}");
                
                try {
                    $response = Http::get($childData['url']);
                    $html = $response->body();
                    
                    // Supress DOM warnings
                    libxml_use_internal_errors(true);
                    $dom = new \DOMDocument();
                    $dom->loadHTML($html);
                    libxml_clear_errors();
                    $xpath = new \DOMXPath($dom);

                    // Finding the main service image
                    // Typically inside .ttm-service-single-content-area img
                    $imageNodes = $xpath->query('//div[contains(@class, "ttm-service-single-content-area")]//img');
                    $imagePath = null;
                    if ($imageNodes->length > 0) {
                        $src = $imageNodes->item(0)->getAttribute('src');
                        if (!str_starts_with($src, 'http')) {
                            $src = 'https://www.shehala.com' . (str_starts_with($src, '/') ? '' : '/') . $src;
                        }
                        
                        // Download image
                        try {
                            $imgContents = file_get_contents($src);
                            if ($imgContents) {
                                $ext = pathinfo($src, PATHINFO_EXTENSION);
                                if (empty($ext) || strlen($ext) > 4) $ext = 'jpg';
                                $imgName = Str::slug($childData['name']) . '-' . time() . '.' . $ext;
                                File::put(public_path('uploads/services/' . $imgName), $imgContents);
                                $imagePath = 'uploads/services/' . $imgName;
                            }
                        } catch (\Exception $e) {
                            $this->command->error("    Failed to download image: $src");
                        }
                    }

                    // Finding the description
                    // Extract content from .ttm-service-description div
                    $descNodes = $xpath->query('//div[contains(@class, "ttm-service-description")]');
                    $descriptionHtml = '';
                    if ($descNodes->length > 0) {
                        // Usually the second one contains the main text, or just combine them
                        foreach ($descNodes as $node) {
                            // Extract inner HTML
                            $innerHTML = "";
                            $children = $node->childNodes;
                            foreach ($children as $child) {
                                $innerHTML .= $node->ownerDocument->saveHTML($child);
                            }
                            $descriptionHtml .= $innerHTML . '<br>';
                        }
                    } else {
                        // Fallback
                        $descriptionHtml = '<p>Description not found for ' . $childData['name'] . '</p>';
                    }

                    // Clean up specific shehala classes if necessary or leave them
                    // Creating the service
                    Service::create([
                        'service_category_id' => $parent->id,
                        'title' => $childData['name'],
                        'slug' => Str::slug($childData['name']),
                        'thumbnail_image' => $imagePath,
                        'description' => $descriptionHtml,
                        'status' => 1
                    ]);

                } catch (\Exception $e) {
                    $this->command->error("  Error scraping {$childData['name']}: " . $e->getMessage());
                    // Create empty service if scraping fails
                    Service::create([
                        'service_category_id' => $parent->id,
                        'title' => $childData['name'],
                        'slug' => Str::slug($childData['name']),
                        'description' => '<p>Error scraping content.</p>',
                        'status' => 1
                    ]);
                }
                
                // Sleep slightly to not hammer the server
                sleep(1);
            }
        }
        
        $this->command->info('Shehala services scraping and seeding completed!');
    }
}
