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
        'migrate'                   => ['label' => 'Database Migration', 'url' => '/setup-step/migrate'],
        'optimize_clear'            => ['label' => 'Cache Clear',        'url' => '/setup-step/optimize-clear'],
        'storage_link'              => ['label' => 'Storage Link',       'url' => '/setup-step/storage-link'],
        'seed_user'                 => ['label' => 'Seed: Admin User',   'url' => '/setup-step/seed-user'],
        'seed_section_settings'     => ['label' => 'Seed: Section Settings', 'url' => '/setup-step/seed-section-settings'],
        'seed_slider'               => ['label' => 'Seed: Slider',       'url' => '/setup-step/seed-slider'],
        'seed_services'             => ['label' => 'Seed: Services',     'url' => '/setup-step/seed-services'],
        'seed_portfolio'            => ['label' => 'Seed: Portfolio',    'url' => '/setup-step/seed-portfolio'],
        'seed_blog'                 => ['label' => 'Seed: Blog',         'url' => '/setup-step/seed-blog'],
        'seed_pages'                => ['label' => 'Seed: Pages',        'url' => '/setup-step/seed-pages'],
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
            '/server-setup-run', 'Dashboard দেখুন');
    }
    try {
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'Database\\Seeders\\PageSeeder', '--force' => true]);
        markSetupStepDone('seed_pages');
        return setupResponse('Seed: Pages', "<p class='ok'>✅ Pages seeded!</p><br><p><b>🎉 সব ধাপ সম্পন্ন!</b></p>",
            '/server-setup-run', 'Dashboard দেখুন');
    } catch (\Exception $e) {
        return setupResponse('Seed: Pages', "<p class='err'>❌ Error: ".e($e->getMessage())."</p><a href='/setup-step/seed-pages' class='btn'>🔄 আবার চেষ্টা করুন</a>");
    }
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
