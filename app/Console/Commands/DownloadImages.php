<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;

class DownloadImages extends Command
{
    protected $signature = 'setup:download-images';
    protected $description = 'Download blog and portfolio images locally';

    public function handle()
    {
        $allImages = [
            // Blog images
            ['type' => 'blog', 'url' => 'https://shehala.com/public/frontend/images/blog/visual_content.png',  'path' => storage_path('app/public/uploads/blogs/8-reasons-why-visual-content-is-important-for-online-marketing-' . md5('https://shehala.com/public/frontend/images/blog/visual_content.png') . '.png')],
            ['type' => 'blog', 'url' => 'https://shehala.com/public/frontend/images/blog/online_business.png', 'path' => storage_path('app/public/uploads/blogs/7-image-editing-tips-to-dominate-in-online-business-' . md5('https://shehala.com/public/frontend/images/blog/online_business.png') . '.png')],
            ['type' => 'blog', 'url' => 'https://shehala.com/public/frontend/images/blog/shehala-ecommerce.png','path' => storage_path('app/public/uploads/blogs/role-and-essence-of-clipping-path-services-for-modern-ecommerce-' . md5('https://shehala.com/public/frontend/images/blog/shehala-ecommerce.png') . '.png')],
            // Portfolio images
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/WMLvf5akTtyuOcLjWfQj.jpg', 'path' => public_path('uploads/portfolios/borsting-consult-' . md5('https://shehala.com/images/portfolio-images/WMLvf5akTtyuOcLjWfQj.jpg') . '.jpg')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/rE3EN50xN3QQTUTz77Kp.jpg', 'path' => public_path('uploads/portfolios/party-fyn-' . md5('https://shehala.com/images/portfolio-images/rE3EN50xN3QQTUTz77Kp.jpg') . '.jpg')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/ghuOHdjCdnmz3UvmN9Ny.jpg', 'path' => public_path('uploads/portfolios/pay-back-' . md5('https://shehala.com/images/portfolio-images/ghuOHdjCdnmz3UvmN9Ny.jpg') . '.jpg')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/wZ8sWbC9PzVwZp7v66n7.jpg', 'path' => public_path('uploads/portfolios/london-bar-' . md5('https://shehala.com/images/portfolio-images/wZ8sWbC9PzVwZp7v66n7.jpg') . '.jpg')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/m7g9rC6H6oZ1U2xN0aD5.jpg', 'path' => public_path('uploads/portfolios/esbjerg-skojteklub-' . md5('https://shehala.com/images/portfolio-images/m7g9rC6H6oZ1U2xN0aD5.jpg') . '.jpg')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/YhDqWp6qU5s5b0K3L7A2.png', 'path' => public_path('uploads/portfolios/arhus-handbold-' . md5('https://shehala.com/images/portfolio-images/YhDqWp6qU5s5b0K3L7A2.png') . '.png')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/l4Q9L7y1q1C4t7zN4L9f.jpg', 'path' => public_path('uploads/portfolios/wega-vinduer-' . md5('https://shehala.com/images/portfolio-images/l4Q9L7y1q1C4t7zN4L9f.jpg') . '.jpg')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/a6B1hV7xX1g1P6E9mR8o.jpg', 'path' => public_path('uploads/portfolios/energiraadet-' . md5('https://shehala.com/images/portfolio-images/a6B1hV7xX1g1P6E9mR8o.jpg') . '.jpg')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/eH5T9l4F1q8hT7kX9J3e.jpg', 'path' => public_path('uploads/portfolios/art-' . md5('https://shehala.com/images/portfolio-images/eH5T9l4F1q8hT7kX9J3e.jpg') . '.jpg')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/X3wK1z2F1m6A3B9Y1P0q.jpg', 'path' => public_path('uploads/portfolios/owo-dk-' . md5('https://shehala.com/images/portfolio-images/X3wK1z2F1m6A3B9Y1P0q.jpg') . '.jpg')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/7B1Q7G8M1H1F7t7W4E5a.jpg', 'path' => public_path('uploads/portfolios/penta-advokater-' . md5('https://shehala.com/images/portfolio-images/7B1Q7G8M1H1F7t7W4E5a.jpg') . '.jpg')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/K6g2K5aZ3m7cZ5Z1eA7u.jpg', 'path' => public_path('uploads/portfolios/gulvcenter-' . md5('https://shehala.com/images/portfolio-images/K6g2K5aZ3m7cZ5Z1eA7u.jpg') . '.jpg')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/5Kdu8PkhDLGfHZi565ZR.jpg', 'path' => public_path('uploads/portfolios/oxeogco-' . md5('https://shehala.com/images/portfolio-images/5Kdu8PkhDLGfHZi565ZR.jpg') . '.jpg')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/afewzMeooebg9nX3IVXZ.jpg', 'path' => public_path('uploads/portfolios/alt-om-handarbejde-' . md5('https://shehala.com/images/portfolio-images/afewzMeooebg9nX3IVXZ.jpg') . '.jpg')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/Ld8r6TL3KDgDPBlc4HOt.jpg', 'path' => public_path('uploads/portfolios/allt-om-handarbete-' . md5('https://shehala.com/images/portfolio-images/Ld8r6TL3KDgDPBlc4HOt.jpg') . '.jpg')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/LZ8huqzTiuS14CncW7GU.jpg', 'path' => public_path('uploads/portfolios/alt-om-handarbeide-norwegian-' . md5('https://shehala.com/images/portfolio-images/LZ8huqzTiuS14CncW7GU.jpg') . '.jpg')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/wJguL4GbKmXFomBGVd5x.jpg', 'path' => public_path('uploads/portfolios/protruck-a-s-' . md5('https://shehala.com/images/portfolio-images/wJguL4GbKmXFomBGVd5x.jpg') . '.jpg')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/ggvt2ZRLxfTMmnnSDJ1s.png', 'path' => public_path('uploads/portfolios/jaguar-the-art-' . md5('https://shehala.com/images/portfolio-images/ggvt2ZRLxfTMmnnSDJ1s.png') . '.png')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/RTxdlN6q9zF8q1wvhjnW.jpg', 'path' => public_path('uploads/portfolios/fisker-automotive-' . md5('https://shehala.com/images/portfolio-images/RTxdlN6q9zF8q1wvhjnW.jpg') . '.jpg')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/M72wLndKoxu6sPYg6XeG.jpg', 'path' => public_path('uploads/portfolios/goalkeeper-academy-' . md5('https://shehala.com/images/portfolio-images/M72wLndKoxu6sPYg6XeG.jpg') . '.jpg')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/wV7eRjf56fgqBYT8dgRn.jpg', 'path' => public_path('uploads/portfolios/high-commission-for-bangladesh-canada-' . md5('https://shehala.com/images/portfolio-images/wV7eRjf56fgqBYT8dgRn.jpg') . '.jpg')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/y5GNzEdI3OycGSmvOPM5.jpg', 'path' => public_path('uploads/portfolios/telt-serviceudlejning-' . md5('https://shehala.com/images/portfolio-images/y5GNzEdI3OycGSmvOPM5.jpg') . '.jpg')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/0qTmbDz7lMydBccYMn3S.jpg', 'path' => public_path('uploads/portfolios/al-ummah-' . md5('https://shehala.com/images/portfolio-images/0qTmbDz7lMydBccYMn3S.jpg') . '.jpg')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/2SC6qwIRc7mX6zKYKIdz.jpg', 'path' => public_path('uploads/portfolios/divider-' . md5('https://shehala.com/images/portfolio-images/2SC6qwIRc7mX6zKYKIdz.jpg') . '.jpg')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/dnRCCc4w3z4QR9aOAZE9.jpg', 'path' => public_path('uploads/portfolios/four-room-divider-large-and-small-' . md5('https://shehala.com/images/portfolio-images/dnRCCc4w3z4QR9aOAZE9.jpg') . '.jpg')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/3kMPM0BuBMW6y64Pomd5.jpg', 'path' => public_path('uploads/portfolios/chair-' . md5('https://shehala.com/images/portfolio-images/3kMPM0BuBMW6y64Pomd5.jpg') . '.jpg')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/bqDvPf27lfyo6B1q6lCU.jpg', 'path' => public_path('uploads/portfolios/sofa-' . md5('https://shehala.com/images/portfolio-images/bqDvPf27lfyo6B1q6lCU.jpg') . '.jpg')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/UoTYkFI9vsVhtCz68GjI.jpg', 'path' => public_path('uploads/portfolios/lima-centre-left-and-right-corner-ottoman-unit-' . md5('https://shehala.com/images/portfolio-images/UoTYkFI9vsVhtCz68GjI.jpg') . '.jpg')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/pzPepz1c2P0zhKOSxglV.jpg', 'path' => public_path('uploads/portfolios/quadro-' . md5('https://shehala.com/images/portfolio-images/pzPepz1c2P0zhKOSxglV.jpg') . '.jpg')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/t6z2QwJdZyENnbkmELIi.jpg', 'path' => public_path('uploads/portfolios/oven-' . md5('https://shehala.com/images/portfolio-images/t6z2QwJdZyENnbkmELIi.jpg') . '.jpg')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/d3vv16gSS002hL2avoU7.jpg', 'path' => public_path('uploads/portfolios/kitchen-hood-' . md5('https://shehala.com/images/portfolio-images/d3vv16gSS002hL2avoU7.jpg') . '.jpg')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/OE6CUe73yKq78QYhP6KO.jpg', 'path' => public_path('uploads/portfolios/pendent-' . md5('https://shehala.com/images/portfolio-images/OE6CUe73yKq78QYhP6KO.jpg') . '.jpg')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/3NdH5ewvzmYdRvPiEHLX.jpg', 'path' => public_path('uploads/portfolios/burda-plus-' . md5('https://shehala.com/images/portfolio-images/3NdH5ewvzmYdRvPiEHLX.jpg') . '.jpg')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/piQ1zfM7onZ3ClcGxRHr.jpg', 'path' => public_path('uploads/portfolios/burda-style-' . md5('https://shehala.com/images/portfolio-images/piQ1zfM7onZ3ClcGxRHr.jpg') . '.jpg')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/DAgbG2nnb33NRIBWA4oY.jpg', 'path' => public_path('uploads/portfolios/burda-easy-' . md5('https://shehala.com/images/portfolio-images/DAgbG2nnb33NRIBWA4oY.jpg') . '.jpg')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/pHNfWcoW34MNiIUWSdXe.jpg', 'path' => public_path('uploads/portfolios/kreative-strik-' . md5('https://shehala.com/images/portfolio-images/pHNfWcoW34MNiIUWSdXe.jpg') . '.jpg')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/x6s5yek268d0Q3hMR8Ql.jpg', 'path' => public_path('uploads/portfolios/strikke-magasin-' . md5('https://shehala.com/images/portfolio-images/x6s5yek268d0Q3hMR8Ql.jpg') . '.jpg')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/6yCs53HoGlDNDb8T3X8e.jpg', 'path' => public_path('uploads/portfolios/sy-magasin-' . md5('https://shehala.com/images/portfolio-images/6yCs53HoGlDNDb8T3X8e.jpg') . '.jpg')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/PAIsGUEnKWC1zNCEXzFN.jpg', 'path' => public_path('uploads/portfolios/newspaper-add-' . md5('https://shehala.com/images/portfolio-images/PAIsGUEnKWC1zNCEXzFN.jpg') . '.jpg')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/lnM3HljjxhgEosm2is29.jpg', 'path' => public_path('uploads/portfolios/newspaper-advertisement-' . md5('https://shehala.com/images/portfolio-images/lnM3HljjxhgEosm2is29.jpg') . '.jpg')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/60cYqAIQ3IK1vkRB2Oju.jpg', 'path' => public_path('uploads/portfolios/newspaper-advertisement-' . md5('https://shehala.com/images/portfolio-images/60cYqAIQ3IK1vkRB2Oju.jpg') . '.jpg')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/pXkouusStxsBodnVRy5j.jpg', 'path' => public_path('uploads/portfolios/newspaper-advertisement-' . md5('https://shehala.com/images/portfolio-images/pXkouusStxsBodnVRy5j.jpg') . '.jpg')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/rVxGTzMoYD35tg5Accyf.jpg', 'path' => public_path('uploads/portfolios/newspaper-advertisement-' . md5('https://shehala.com/images/portfolio-images/rVxGTzMoYD35tg5Accyf.jpg') . '.jpg')],
            ['type' => 'portfolio', 'url' => 'https://shehala.com/images/portfolio-images/rMFYrXw99HFuZwbj3eeN.jpg', 'path' => public_path('uploads/portfolios/newspaper-advertisement-' . md5('https://shehala.com/images/portfolio-images/rMFYrXw99HFuZwbj3eeN.jpg') . '.jpg')],
        ];

        $total = count($allImages);
        $downloadedCount = 0;
        $failedCount = 0;
        $skippedCount = 0;

        $this->info("Starting download of {$total} images...");

        foreach ($allImages as $index => $img) {
            $num = $index + 1;
            if (file_exists($img['path'])) {
                $skippedCount++;
                continue;
            }

            $dir = dirname($img['path']);
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }

            $this->output->write("[{$num}/{$total}] Downloading {$img['url']}... ");

            try {
                // Try using Laravel HTTP client
                $response = Http::withoutVerifying()
                    ->withUserAgent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36')
                    ->timeout(20)
                    ->get($img['url']);

                if ($response->successful()) {
                    File::put($img['path'], $response->body());
                    $this->info("✅ SUCCESS (" . basename($img['path']) . ")");
                    $downloadedCount++;
                } else {
                    $this->error("❌ FAILED (Status: " . $response->status() . ")");
                    $failedCount++;
                }
            } catch (\Exception $e) {
                // Fallback to stream context
                try {
                    $ctx = stream_context_create([
                        'http' => [
                            'timeout' => 20,
                            'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\r\n"
                        ],
                        'ssl' => [
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                        ]
                    ]);
                    $contents = @file_get_contents($img['url'], false, $ctx);
                    if ($contents) {
                        File::put($img['path'], $contents);
                        $this->info("✅ SUCCESS (Fallback)");
                        $downloadedCount++;
                    } else {
                        $this->error("❌ FAILED (" . $e->getMessage() . ")");
                        $failedCount++;
                    }
                } catch (\Exception $e2) {
                    $this->error("❌ EXCEPTION (" . $e2->getMessage() . ")");
                    $failedCount++;
                }
            }
        }

        $this->info("\n--- Download Summary ---");
        $this->info("Total: {$total}");
        $this->info("Downloaded: {$downloadedCount}");
        $this->info("Skipped (already exists): {$skippedCount}");
        $this->info("Failed: {$failedCount}");
    }
}
