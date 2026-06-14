<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class SectionSettingsSeeder extends Seeder
{
    public function run()
    {
        $banners = [
            'service_banner_image' => 'https://www.shehala.com/public/frontend/images/webdesign.jpg',
            'portfolio_banner_image' => 'https://www.shehala.com/public/frontend/images/project.jpg',
            'blog_banner_image' => 'https://www.shehala.com/public/frontend/images/aboutbg.jpg',
            'page_banner_image' => 'https://www.shehala.com/public/frontend/images/aboutbg.jpg',
        ];

        $uploadPath = public_path('uploads/settings');
        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true);
        }

        foreach ($banners as $key => $url) {
            try {
                $response = Http::withUserAgent('Mozilla/5.0 (Windows NT 10.0; Win64; x64 AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36)')->get($url);
                
                if ($response->successful()) {
                    $filename = basename($url);
                    $savedPath = 'uploads/settings/' . $filename;
                    File::put(public_path($savedPath), $response->body());

                    Setting::updateOrCreate(
                        ['key' => $key],
                        ['value' => $savedPath]
                    );
                    $this->command->info("Downloaded and saved $key");
                } else {
                    $this->command->warn("Failed to download image from: $url. Status: " . $response->status());
                }
            } catch (\Exception $e) {
                $this->command->error("Exception for $url: " . $e->getMessage());
            }
        }
    }
}
