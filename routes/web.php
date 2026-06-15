<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontendController;

Route::get('/', [FrontendController::class, 'index'])->name('home');

Route::post('/contact-us', [\App\Http\Controllers\Frontend\ContactController::class, 'submit'])->name('contact.submit');

Route::get('/server-setup-run', function () {
    try {
        // Run migrations first so tables exist
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        $output = "Migrations run successfully.<br>";

        // Clear all caches
        \Illuminate\Support\Facades\Artisan::call('optimize:clear');
        $output .= "Caches cleared successfully.<br>";

        // Create storage link
        \Illuminate\Support\Facades\Artisan::call('storage:link');
        $output .= "Storage link created successfully.<br>";

        // Run seeders
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--force' => true]);
        $output .= "Seeders run successfully.<br>";

        return $output . "<br><b>All commands executed successfully! You can now use your website.</b>";
    } catch (\Exception $e) {
        return "<b>Error:</b> " . $e->getMessage();
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
