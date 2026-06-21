<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Blog;
use Illuminate\Support\Facades\File;

class ShehalaBlogSeeder extends Seeder
{
    public function run()
    {
        // Smart Check: we won't skip completely so we can fix missing images
        // if (Blog::count() > 0) { ... } removed

        // Create upload directory if it doesn't exist in the storage disk
        $uploadPath = storage_path('app/public/uploads/blogs');
        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true);
        }

        $this->command->info("Seeding Shehala Blog Data...");

        $items = [
            [
                "title" => "8 Reasons Why Visual Content is Important for Online Marketing",
                "image" => "https://shehala.com/public/frontend/images/blog/visual_content.png",
                "website_url" => "https://shehala.com/8-reasons-why-visual-content-is-important-for-online-marketing",
                "description" => "<p>Every day millions of contents are posted online in different forms of posts like blog articles, e-books, whitepapers, slide shows, infographics and videos. People are overloaded with information when it comes to the matter of buying a product or service. Just imagine how much information gets published each day from millions of internet marketers, and how they are struggling to get leads for business. Your content may easily get lost in the jungle of contents and it is even harder to be noticed by your targeted customers. What is the best way to stand out in the crowd?</p>\r\n<p>Visualized data can be the best answer for an effective content marketing campaign and attract people easily. Visualized content like images or infographics has great power to grab attention, increase reader engagement and let them share the content in their network. Here is the fact what makes images and infographics important in online marketing.</p>"
            ],
            [
                "title" => "7 Image Editing Tips To Dominate In Online Business",
                "image" => "https://shehala.com/public/frontend/images/blog/online_business.png",
                "website_url" => "https://shehala.com/7-image-editing-tips-to-dominate-in-online-business",
                "description" => "<p>If you are planning to set up an online business or take your business ahead, you should consider image quality of your websites seriously. A bad quality image may hurt your conversion rate. Even it may increase bounce rate in search engines that results lower position in search engine. A good quality image tends to attract more people in a post and converts well then other formats of web content.</p>\r\n<p>Human eyes love colors and attractive images. In an online business, a customer looks at images first, and then move to other parts of a website. Therefore, it is crucial to have </p>"
            ],
            [
                "title" => "Role and Essence of Clipping Path Services for Modern Ecommerce",
                "image" => "https://shehala.com/public/frontend/images/blog/shehala-ecommerce.png",
                "website_url" => "https://shehala.com/role-and-essence-of-clipping-path-services-for-modern-ecommerce",
                "description" => "<p>Linking Clipping Path Design and the Primary Goal of eCommerce</p>\r\n<p>It is now common knowledge that clipping path design has a dominant role in modern online marketing. Among most online marketing gurus, clipping path has, and more than ever before, gained perhaps one of the most critical. The problem however, is not in affirming the critical role of clipping path design, but ensuring that clipping path designs are able to play that role effectively, reliably, and sustainably.</p>\r\n<p>Today, clipping path services incorporate more than just a graphic design venture. Among industry experts, clipping path services denote a process that helps amplify, assert, and propel the marketing need of modern online business. In other words, clipping path services are and should be a vehicle of successful online marketing, where they effectively serve the primary goal of any eCommerce establishment. This explains why the best clipping path services for eCommerce platforms, must necessarily</p>"
            ]
        ];

        foreach ($items as $item) {
            $slug = Str::slug($item['title']);

            // Generate local image name (no download here — images fetched separately)
            $ext = pathinfo(parse_url($item['image'], PHP_URL_PATH), PATHINFO_EXTENSION);
            if (empty($ext) || strlen($ext) > 4) $ext = 'jpg';
            $imgName = $slug . '-' . md5($item['image']) . '.' . $ext;
            $imagePath = 'uploads/blogs/' . $imgName;

            // Create or update the blog post (no HTTP call, instant!)
            $blog = Blog::where('slug', $slug)->first();
            if (!$blog) {
                Blog::create([
                    'slug'         => $slug,
                    'title'        => $item['title'],
                    'content'      => $item['description'],
                    'thumbnail'    => $imagePath,   // path saved; image downloaded later
                    'status'       => 'published',
                    'published_at' => now(),
                    'meta_title'   => $item['title'],
                    // Store original URL so the download route can fetch it
                    // (uses 'meta_description' column as temp store if available, or just rely on filename)
                ]);
            } else {
                $blog->update(['thumbnail' => $imagePath]);
            }
        }

        $this->command->info("Successfully seeded all blog items!");
    }
}
