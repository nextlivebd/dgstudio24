<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontendController;

Route::get('/', [FrontendController::class, 'index'])->name('home');

Route::post('/contact-us', [\App\Http\Controllers\Frontend\ContactController::class, 'submit'])->name('contact.submit');

// ─────────────────────────────────────────────────────────────────
//  SERVER SETUP — STEP BY STEP (TIMEOUT-SAFE)
//  প্রতিটি ধাপ আলাদাভাবে রান হয়, সম্পন্ন ধাপ স্কিপ হয়।
//  Progress file: storage/app/setup_progress.json
// ─────────────────────────────────────────────────────────────────

// Helper: progress ফাইল থেকে সম্পন্ন ধাপ পড়া
function getSetupProgress(): array {
    $file = storage_path('app/setup_progress.json');
    if (!file_exists($file)) return [];
    return json_decode(file_get_contents($file), true) ?? [];
}

// Helper: একটি ধাপ সম্পন্ন হিসেবে মার্ক করা
function markSetupStepDone(string $step): void {
    $file = storage_path('app/setup_progress.json');
    $progress = getSetupProgress();
    $progress[$step] = ['done' => true, 'time' => now()->toDateTimeString()];
    file_put_contents($file, json_encode($progress, JSON_PRETTY_PRINT));
}

// Helper: একটি ধাপ সম্পন্ন কিনা
function isSetupStepDone(string $step): bool {
    return getSetupProgress()[$step]['done'] ?? false;
}

// Helper: সুন্দর HTML রেসপন্স
function setupResponse(string $title, string $body, string $nextUrl = '', string $nextLabel = ''): string {
    $next = $nextUrl ? "<br><br><a href='{$nextUrl}' style='background:#2563eb;color:#fff;padding:10px 24px;border-radius:8px;text-decoration:none;font-weight:bold;'>➡ {$nextLabel}</a>" : '';
    return "<!DOCTYPE html><html><head><meta charset='UTF-8'><title>Setup</title>
    <style>body{font-family:sans-serif;max-width:700px;margin:40px auto;padding:20px;background:#f8fafc;}
    h2{color:#1e40af;} .box{background:#fff;border-radius:12px;padding:24px;box-shadow:0 2px 12px rgba(0,0,0,.08);}
    .ok{color:#16a34a;font-weight:bold;} .skip{color:#9ca3af;} .err{color:#dc2626;font-weight:bold;}
    a.btn{background:#2563eb;color:#fff;padding:10px 24px;border-radius:8px;text-decoration:none;font-weight:bold;display:inline-block;margin-top:16px;}
    </style></head><body><div class='box'><h2>⚙️ Server Setup — {$title}</h2>{$body}{$next}</div></body></html>";
}

// ── Dashboard (সব ধাপের অবস্থা দেখা) ──────────────────────────
Route::get('/server-setup-run', function () {
    $steps = [
        'migrate'                   => ['label' => 'Database Migration',        'url' => '/setup-step/migrate'],
        'optimize_clear'            => ['label' => 'Cache Clear',               'url' => '/setup-step/optimize-clear'],
        'storage_link'              => ['label' => 'Storage Link',              'url' => '/setup-step/storage-link'],
        'seed_user'                 => ['label' => 'Seed: Admin User',          'url' => '/setup-step/seed-user'],
        'seed_section_settings'     => ['label' => 'Seed: Section Settings',    'url' => '/setup-step/seed-section-settings'],
        'seed_slider'               => ['label' => 'Seed: Slider',              'url' => '/setup-step/seed-slider'],
        'seed_services'             => ['label' => 'Seed: Services',            'url' => '/setup-step/seed-services'],
        'seed_portfolio'            => ['label' => 'Seed: Portfolio',           'url' => '/setup-step/seed-portfolio'],
        'seed_blog'                 => ['label' => 'Seed: Blog',                'url' => '/setup-step/seed-blog'],
        'seed_pages'                => ['label' => 'Seed: Pages',               'url' => '/setup-step/seed-pages'],
        'seed_home_video_banner'    => ['label' => 'Seed: Home Video Banner',   'url' => '/setup-step/seed-home-video-banner'],
    ];

    $progress = getSetupProgress();
    $allDone = true;
    $nextUrl = null;
    $nextLabel = null;

    $rows = '';
    foreach ($steps as $key => $info) {
        $done = $progress[$key]['done'] ?? false;
        if (!$done) {
            $allDone = false;
            if (!$nextUrl) { $nextUrl = $info['url']; $nextLabel = $info['label']; }
            $icon = '⬜';
            $time = "<a href='{$info['url']}' style='color:#2563eb;'>Run Now</a>";
        } else {
            $icon = '✅';
            $time = "<span style='color:#9ca3af;font-size:13px;'>" . ($progress[$key]['time'] ?? '') . "</span>";
        }
        $rows .= "<tr><td>{$icon}</td><td>{$info['label']}</td><td>{$time}</td></tr>";
    }

    $table = "<table style='width:100%;border-collapse:collapse;margin-top:16px;'>
        <tr style='background:#f1f5f9;'><th style='padding:8px;text-align:left;'>Status</th><th style='padding:8px;text-align:left;'>Step</th><th style='padding:8px;text-align:left;'>Time / Action</th></tr>
        {$rows}</table>";

    if ($allDone) {
        $action = "<br><br><span class='ok'>🎉 সব ধাপ সম্পন্ন! আপনার ওয়েবসাইট প্রস্তুত।</span>
        <br><br><a href='/' class='btn'>🏠 ওয়েবসাইটে যান</a>
        &nbsp;<a href='/server-setup-reset' class='btn' style='background:#dc2626;'>🗑 Reset Progress</a>";
    } else {
        $action = "<br><a href='{$nextUrl}' class='btn'>▶ পরবর্তী ধাপ: {$nextLabel}</a>";
    }

    return setupResponse('Dashboard', $table . $action);
});

// ── Reset progress ──────────────────────────────────────────────
Route::get('/server-setup-reset', function () {
    $file = storage_path('app/setup_progress.json');
    if (file_exists($file)) unlink($file);
    return redirect('/server-setup-run');
});

// ── Step 1: Migrate ─────────────────────────────────────────────
Route::get('/setup-step/migrate', function () {
    if (isSetupStepDone('migrate')) {
        return setupResponse('Migration', "<p class='skip'>⏭ ইতিমধ্যে সম্পন্ন, স্কিপ করা হয়েছে।</p>",
            '/setup-step/optimize-clear', 'Cache Clear');
    }
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        $out = \Illuminate\Support\Facades\Artisan::output();
        markSetupStepDone('migrate');
        return setupResponse('Migration', "<p class='ok'>✅ Migration সফল!</p><pre style='background:#f1f5f9;padding:12px;border-radius:6px;font-size:13px;'>".e($out)."</pre>",
            '/setup-step/optimize-clear', 'Cache Clear');
    } catch (\Exception $e) {
        return setupResponse('Migration', "<p class='err'>❌ Error: ".e($e->getMessage())."</p><a href='/setup-step/migrate' class='btn'>🔄 আবার চেষ্টা করুন</a>");
    }
});

// ── Step 2: Cache Clear ─────────────────────────────────────────
Route::get('/setup-step/optimize-clear', function () {
    if (isSetupStepDone('optimize_clear')) {
        return setupResponse('Cache Clear', "<p class='skip'>⏭ ইতিমধ্যে সম্পন্ন, স্কিপ করা হয়েছে।</p>",
            '/setup-step/storage-link', 'Storage Link');
    }
    try {
        \Illuminate\Support\Facades\Artisan::call('optimize:clear');
        markSetupStepDone('optimize_clear');
        return setupResponse('Cache Clear', "<p class='ok'>✅ Cache সফলভাবে Clear হয়েছে!</p>",
            '/setup-step/storage-link', 'Storage Link');
    } catch (\Exception $e) {
        return setupResponse('Cache Clear', "<p class='err'>❌ Error: ".e($e->getMessage())."</p><a href='/setup-step/optimize-clear' class='btn'>🔄 আবার চেষ্টা করুন</a>");
    }
});

// ── Step 3: Storage Link ────────────────────────────────────────
Route::get('/setup-step/storage-link', function () {
    if (isSetupStepDone('storage_link')) {
        return setupResponse('Storage Link', "<p class='skip'>⏭ ইতিমধ্যে সম্পন্ন, স্কিপ করা হয়েছে।</p>",
            '/setup-step/seed-user', 'Seed Admin User');
    }
    try {
        \Illuminate\Support\Facades\Artisan::call('storage:link');
        markSetupStepDone('storage_link');
        return setupResponse('Storage Link', "<p class='ok'>✅ Storage link তৈরি হয়েছে!</p>",
            '/setup-step/seed-user', 'Seed Admin User');
    } catch (\Exception $e) {
        // Already exists is OK
        markSetupStepDone('storage_link');
        return setupResponse('Storage Link', "<p class='ok'>✅ Storage link (ইতিমধ্যে বিদ্যমান) — OK!</p>",
            '/setup-step/seed-user', 'Seed Admin User');
    }
});

// ── Step 4: Seed Admin User ─────────────────────────────────────
Route::get('/setup-step/seed-user', function () {
    if (isSetupStepDone('seed_user')) {
        return setupResponse('Seed: Admin User', "<p class='skip'>⏭ ইতিমধ্যে সম্পন্ন, স্কিপ করা হয়েছে।</p>",
            '/setup-step/seed-section-settings', 'Seed Section Settings');
    }
    try {
        \App\Models\User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            ['name' => 'Admin', 'password' => \Illuminate\Support\Facades\Hash::make('password'), 'email_verified_at' => now()]
        );
        markSetupStepDone('seed_user');
        return setupResponse('Seed: Admin User', "<p class='ok'>✅ Admin user তৈরি/যাচাই হয়েছে!</p>",
            '/setup-step/seed-section-settings', 'Seed Section Settings');
    } catch (\Exception $e) {
        return setupResponse('Seed: Admin User', "<p class='err'>❌ Error: ".e($e->getMessage())."</p><a href='/setup-step/seed-user' class='btn'>🔄 আবার চেষ্টা করুন</a>");
    }
});

// ── Step 5: Seed Section Settings ──────────────────────────────
Route::get('/setup-step/seed-section-settings', function () {
    if (isSetupStepDone('seed_section_settings')) {
        return setupResponse('Seed: Section Settings', "<p class='skip'>⏭ ইতিমধ্যে সম্পন্ন, স্কিপ করা হয়েছে।</p>",
            '/setup-step/seed-slider', 'Seed Slider');
    }
    try {
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'Database\\Seeders\\SectionSettingsSeeder', '--force' => true]);
        markSetupStepDone('seed_section_settings');
        return setupResponse('Seed: Section Settings', "<p class='ok'>✅ Section Settings seeded!</p>",
            '/setup-step/seed-slider', 'Seed Slider');
    } catch (\Exception $e) {
        return setupResponse('Seed: Section Settings', "<p class='err'>❌ Error: ".e($e->getMessage())."</p><a href='/setup-step/seed-section-settings' class='btn'>🔄 আবার চেষ্টা করুন</a>");
    }
});

// ── Step 6: Seed Slider ─────────────────────────────────────────
Route::get('/setup-step/seed-slider', function () {
    if (isSetupStepDone('seed_slider')) {
        return setupResponse('Seed: Slider', "<p class='skip'>⏭ ইতিমধ্যে সম্পন্ন, স্কিপ করা হয়েছে।</p>",
            '/setup-step/seed-services', 'Seed Services');
    }
    try {
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'Database\\Seeders\\SliderSeeder', '--force' => true]);
        markSetupStepDone('seed_slider');
        return setupResponse('Seed: Slider', "<p class='ok'>✅ Slider seeded!</p>",
            '/setup-step/seed-services', 'Seed Services');
    } catch (\Exception $e) {
        return setupResponse('Seed: Slider', "<p class='err'>❌ Error: ".e($e->getMessage())."</p><a href='/setup-step/seed-slider' class='btn'>🔄 আবার চেষ্টা করুন</a>");
    }
});

// ── Step 7: Seed Services ───────────────────────────────────────
Route::get('/setup-step/seed-services', function () {
    if (isSetupStepDone('seed_services')) {
        return setupResponse('Seed: Services', "<p class='skip'>⏭ ইতিমধ্যে সম্পন্ন, স্কিপ করা হয়েছে।</p>",
            '/setup-step/seed-portfolio', 'Seed Portfolio');
    }
    try {
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'Database\\Seeders\\ShehalaServiceSeeder', '--force' => true]);
        markSetupStepDone('seed_services');
        return setupResponse('Seed: Services', "<p class='ok'>✅ Services seeded!</p>",
            '/setup-step/seed-portfolio', 'Seed Portfolio');
    } catch (\Exception $e) {
        return setupResponse('Seed: Services', "<p class='err'>❌ Error: ".e($e->getMessage())."</p><a href='/setup-step/seed-services' class='btn'>🔄 আবার চেষ্টা করুন</a>");
    }
});

// ── Step 8: Seed Portfolio ──────────────────────────────────────
Route::get('/setup-step/seed-portfolio', function () {
    if (isSetupStepDone('seed_portfolio')) {
        return setupResponse('Seed: Portfolio', "<p class='skip'>⏭ ইতিমধ্যে সম্পন্ন, স্কিপ করা হয়েছে।</p>",
            '/setup-step/seed-blog', 'Seed Blog');
    }
    try {
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'Database\\Seeders\\ShehalaPortfolioSeeder', '--force' => true]);
        markSetupStepDone('seed_portfolio');
        return setupResponse('Seed: Portfolio', "<p class='ok'>✅ Portfolio seeded!</p>",
            '/setup-step/seed-blog', 'Seed Blog');
    } catch (\Exception $e) {
        return setupResponse('Seed: Portfolio', "<p class='err'>❌ Error: ".e($e->getMessage())."</p><a href='/setup-step/seed-portfolio' class='btn'>🔄 আবার চেষ্টা করুন</a>");
    }
});

// ── Step 9: Seed Blog ───────────────────────────────────────────
Route::get('/setup-step/seed-blog', function () {
    if (isSetupStepDone('seed_blog')) {
        return setupResponse('Seed: Blog', "<p class='skip'>⏭ ইতিমধ্যে সম্পন্ন, স্কিপ করা হয়েছে।</p>",
            '/setup-step/seed-pages', 'Seed Pages');
    }
    try {
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'Database\\Seeders\\ShehalaBlogSeeder', '--force' => true]);
        markSetupStepDone('seed_blog');
        return setupResponse('Seed: Blog', "<p class='ok'>✅ Blog seeded!</p>",
            '/setup-step/seed-pages', 'Seed Pages');
    } catch (\Exception $e) {
        return setupResponse('Seed: Blog', "<p class='err'>❌ Error: ".e($e->getMessage())."</p><a href='/setup-step/seed-blog' class='btn'>🔄 আবার চেষ্টা করুন</a>");
    }
});

// ── Step 10: Seed Pages (সবচেয়ে ভারী) ─────────────────────────
Route::get('/setup-step/seed-pages', function () {
    if (isSetupStepDone('seed_pages')) {
        return setupResponse('Seed: Pages', "<p class='skip'>⏭ ইতিমধ্যে সম্পন্ন, স্কিপ করা হয়েছে।</p>",
            '/setup-step/seed-home-video-banner', 'Seed Home Video Banner');
    }
    try {
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'Database\\Seeders\\PageSeeder', '--force' => true]);
        markSetupStepDone('seed_pages');
        return setupResponse('Seed: Pages', "<p class='ok'>✅ Pages seeded!</p>",
            '/setup-step/seed-home-video-banner', 'Seed Home Video Banner');
    } catch (\Exception $e) {
        return setupResponse('Seed: Pages', "<p class='err'>❌ Error: ".e($e->getMessage())."</p><a href='/setup-step/seed-pages' class='btn'>🔄 আবার চেষ্টা করুন</a>");
    }
});

// ── Step 11: Seed Home Video Banner ─────────────────────────────
Route::get('/setup-step/seed-home-video-banner', function () {
    if (isSetupStepDone('seed_home_video_banner')) {
        return setupResponse('Seed: Home Video Banner', "<p class='skip'>⏭ ইতিমধ্যে সম্পন্ন, স্কিপ করা হয়েছে।</p>",
            '/server-setup-run', 'Dashboard দেখুন');
    }
    try {
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'Database\\Seeders\\HomeVideoBannerSeeder', '--force' => true]);
        markSetupStepDone('seed_home_video_banner');
        return setupResponse('Seed: Home Video Banner', "<p class='ok'>✅ Home Video Banner seeded!</p><br><p><b>🎉 সব ধাপ সম্পন্ন!</b></p>",
            '/server-setup-run', 'Dashboard দেখুন');
    } catch (\Exception $e) {
        return setupResponse('Seed: Home Video Banner', "<p class='err'>❌ Error: ".e($e->getMessage())."</p><a href='/setup-step/seed-home-video-banner' class='btn'>🔄 আবার চেষ্টা করুন</a>");
    }
});

// ── Image Downloader (Blog + Portfolio, একটি একটি করে) ──────────
// প্রতিটি হিটে একটি ইমেজ ডাউনলোড হয়। Timeout নিরাপদ।
Route::get('/setup-download-images', function () {
    // সব ইমেজ যেগুলো ডাউনলোড করতে হবে
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

    $progressFile = storage_path('app/setup_progress.json');

    // Handle retry failed images request
    if (request()->has('retry')) {
        $progress = [];
        if (file_exists($progressFile)) {
            $progress = json_decode(file_get_contents($progressFile), true) ?? [];
        }
        unset($progress['failed_images']);
        file_put_contents($progressFile, json_encode($progress, JSON_PRETTY_PRINT));
        return redirect('/setup-download-images');
    }

    $progress = [];
    if (file_exists($progressFile)) {
        $progress = json_decode(file_get_contents($progressFile), true) ?? [];
    }
    $failedList = $progress['failed_images'] ?? [];

    $total = count($allImages);
    $done = 0;
    $failedCount = 0;

    // Count completed and failed images
    foreach ($allImages as $img) {
        if (file_exists($img['path'])) {
            $done++;
        } elseif (isset($failedList[$img['url']])) {
            $failedCount++;
        }
    }

    // Find the first image that hasn't been downloaded or marked failed yet and download just that one
    $downloaded = null;
    foreach ($allImages as $img) {
        if (file_exists($img['path']) || isset($failedList[$img['url']])) {
            continue;
        }

        if ($downloaded === null) {
            // Ensure directory exists
            $dir = dirname($img['path']);
            if (!is_dir($dir)) mkdir($dir, 0755, true);

            try {
                // Method 1: Laravel's Http client with SSL verification bypassed and proper User-Agent
                $response = \Illuminate\Support\Facades\Http::withoutVerifying()
                    ->withUserAgent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36')
                    ->timeout(15)
                    ->get($img['url']);

                if ($response->successful()) {
                    file_put_contents($img['path'], $response->body());
                    $downloaded = basename($img['path']) . " ({$img['type']})";
                    $done++;
                } else {
                    // Method 2: Fallback to stream context with bypassed SSL and User-Agent
                    $ctx = stream_context_create([
                        'http' => [
                            'timeout' => 15,
                            'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\r\n"
                        ],
                        'ssl' => [
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                        ]
                    ]);
                    $contents = @file_get_contents($img['url'], false, $ctx);
                    if ($contents) {
                        file_put_contents($img['path'], $contents);
                        $downloaded = basename($img['path']) . " ({$img['type']})";
                        $done++;
                    } else {
                        $progress['failed_images'][$img['url']] = true;
                        file_put_contents($progressFile, json_encode($progress, JSON_PRETTY_PRINT));
                        $failedCount++;
                        $downloaded = "❌ Failed: " . $img['url'] . " (Status: " . $response->status() . ")";
                    }
                }
            } catch (\Exception $e) {
                // Method 2 fallback in case of Exception
                try {
                    $ctx = stream_context_create([
                        'http' => [
                            'timeout' => 15,
                            'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\r\n"
                        ],
                        'ssl' => [
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                        ]
                    ]);
                    $contents = @file_get_contents($img['url'], false, $ctx);
                    if ($contents) {
                        file_put_contents($img['path'], $contents);
                        $downloaded = basename($img['path']) . " ({$img['type']})";
                        $done++;
                    } else {
                        $progress['failed_images'][$img['url']] = true;
                        file_put_contents($progressFile, json_encode($progress, JSON_PRETTY_PRINT));
                        $failedCount++;
                        $downloaded = "❌ Failed: " . $img['url'] . " (" . $e->getMessage() . ")";
                    }
                } catch (\Exception $e2) {
                    $progress['failed_images'][$img['url']] = true;
                    file_put_contents($progressFile, json_encode($progress, JSON_PRETTY_PRINT));
                    $failedCount++;
                    $downloaded = "❌ Error: " . $e->getMessage() . " / " . $e2->getMessage();
                }
            }
        }
    }

    $remaining = $total - $done - $failedCount;

    $statusMsg = $downloaded
        ? "<p class='ok'>Status: <b>{$downloaded}</b></p>"
        : "<p class='ok'>🎉 সমস্ত ইমেজ ডাউনলোড সম্পন্ন!</p>";

    $progressMsg = "<p>মোট: <b>{$total}</b> | সফল: <b>{$done}</b>" . ($failedCount > 0 ? " | ব্যর্থ: <b style='color:#dc2626;'>{$failedCount}</b>" : "") . " | বাকি: <b>{$remaining}</b></p>";
    $progressPct = $total > 0 ? round((($done + $failedCount) / $total) * 100) : 100;
    $bar = "<div style='background:#e5e7eb;border-radius:8px;height:20px;margin:12px 0;'>
        <div style='background:#16a34a;width:{$progressPct}%;height:100%;border-radius:8px;transition:width .3s;'></div>
    </div><p style='text-align:center;'>{$progressPct}%</p>";

    if ($failedCount > 0) {
        $bar .= "<p style='text-align:center;'><a href='/setup-download-images?retry=1' class='btn' style='background:#ea580c;color:#fff;'>🔄 ব্যর্থ ইমেজগুলো আবার চেষ্টা করুন (Retry Failed)</a></p>";
    }

    // Auto-refresh script (1 second if success, 2 seconds if failed)
    $autoRedirect = "";
    if ($remaining > 0) {
        $delay = (str_contains($downloaded ?? '', '❌') || str_contains($downloaded ?? '', 'Error')) ? 2000 : 1000;
        $autoRedirect = "<script>setTimeout(function(){ window.location.href = '/setup-download-images'; }, {$delay});</script>";
    }

    if ($remaining > 0) {
        return setupResponse('Image Download', $statusMsg . $progressMsg . $bar . $autoRedirect,
            '/setup-download-images', "পরবর্তী ইমেজ ({$remaining} বাকি)");
    }

    return setupResponse('Image Download', $statusMsg . $progressMsg . $bar . "<p>সব ইমেজ ডাউনলোড হয়েছে!</p>",
        '/server-setup-run', 'Dashboard এ ফিরুন');
});

// Pages
Route::get('/portfolio', [FrontendController::class, 'portfolio'])->name('portfolio');
Route::get('/portfolio-details/{id}/{slug?}', [FrontendController::class, 'portfolioDetails'])->name('portfolio.details');
Route::get('/blog', [FrontendController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}', [FrontendController::class, 'blogDetails'])->name('blog.details');
Route::get('/contact-us', [FrontendController::class, 'contactUs'])->name('contact_us');

// Quick Links
Route::view('/why-shehala-it-limited', 'frontend.pages.why_shehala_it_limited')->name('why_shehala_it_limited');
Route::view('/code-of-conduct', 'frontend.pages.code_of_conduct')->name('code_of_conduct');
Route::view('/our-mission', 'frontend.pages.our_mission')->name('our_mission');
Route::view('/hse-policy', 'frontend.pages.hse_policy')->name('hse_policy');
Route::view('/development-life-cycle', 'frontend.pages.development_life_cycle')->name('development_life_cycle');
Route::view('/offshore-development-centre', 'frontend.pages.offshore_development_centre')->name('offshore_development_centre');
Route::view('/technology-expertise', 'frontend.pages.technology_expertise')->name('technology_expertise');

// Test Database Route
Route::get('/test-users', function () {
    try {
        $users = \App\Models\User::all();
        return response()->json([
            'status' => 'success',
            'count' => $users->count(),
            'users' => $users
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
    }
});

// Session Test Routes
Route::get('/set-session', function () {
    $random = \Illuminate\Support\Str::random(10);
    session(['test_session_key' => $random]);
    return "Session key set to: " . $random . "<br><a href='/get-session'>Click here to check if it saved</a>";
});

Route::get('/get-session', function () {
    $value = session('test_session_key', 'NOT_FOUND_OR_FAILED');
    return "Session key is: " . $value . "<br>If it says 'NOT_FOUND_OR_FAILED', your server's session storage is not working!";
});

// Dynamic Service Route (Must be at the very bottom)
Route::get('/{slug}', [FrontendController::class, 'serviceDetails'])
    ->where('slug', '^(?!(admin|login|logout|forgot-password|reset-password|up)$)[^/]+$')
    ->name('service.details');
