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

            $parent = ServiceCategory::firstOrCreate(
                ['slug' => Str::slug($catData['name'])],
                [
                    'name'        => $catData['name'],
                    'icon'        => $catData['icon'],
                    'description' => $catData['description'],
                    'status'      => 1
                ]
            );

            foreach ($catData['children'] as $childData) {
                // Create service instantly — no HTTP call, no scraping, no sleep
                Service::firstOrCreate(
                    ['slug' => Str::slug($childData['name'])],
                    [
                        'service_category_id' => $parent->id,
                        'title'               => $childData['name'],
                        'thumbnail_image'     => null,
                        'description'         => '<p>' . $childData['name'] . ' service by DG Studio 24. Content coming soon.</p>',
                        'status'              => 1
                    ]
                );
                $this->command->line("  ✅ Created: {$childData['name']}");
            }
        }

        $this->command->info('Services seeded successfully!');
    }
}
