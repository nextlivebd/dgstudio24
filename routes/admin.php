<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\PageController;

// Auth Routes (Guest)
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('forgot-password', [AuthController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password', [AuthController::class, 'reset'])->name('password.update');
});

// Admin Routes (Authenticated)
Route::middleware('admin')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Page Management CRUD
    Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
    Route::get('/pages/create', [PageController::class, 'create'])->name('pages.create');
    Route::post('/pages', [PageController::class, 'store'])->name('pages.store');
    Route::get('/pages/{id}/edit', [PageController::class, 'edit'])->name('pages.edit');
    Route::put('/pages/{id}', [PageController::class, 'update'])->name('pages.update');
    Route::delete('/pages/{id}', [PageController::class, 'destroy'])->name('pages.destroy');
    
    // Site Settings
    Route::get('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
    
    // Contacts (Frontend submissions)
    Route::get('/contacts', [\App\Http\Controllers\Admin\ContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{contact}', [\App\Http\Controllers\Admin\ContactController::class, 'show'])->name('contacts.show');
    Route::delete('/contacts/{contact}', [\App\Http\Controllers\Admin\ContactController::class, 'destroy'])->name('contacts.destroy');

    // Office Contact Informations
    Route::resource('contact-informations', \App\Http\Controllers\Admin\ContactInformationController::class)->except(['show']);

    // Categories
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class)->except(['show']);

    // Service Categories
    Route::resource('service-categories', \App\Http\Controllers\Admin\ServiceCategoryController::class)->except(['show']);

    // Services
    Route::get('/services/section/edit', [\App\Http\Controllers\Admin\ServiceController::class, 'editSection'])->name('services.section.edit');
    Route::put('/services/section', [\App\Http\Controllers\Admin\ServiceController::class, 'updateSection'])->name('services.section.update');
    Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class)->except(['show']);

    // Portfolio Categories
    Route::resource('portfolio-categories', \App\Http\Controllers\Admin\PortfolioCategoryController::class)->except(['show']);

    // Portfolios
    Route::resource('portfolios', \App\Http\Controllers\Admin\PortfolioController::class)->except(['show']);

    // Blogs
    Route::post('blogs/upload-image', [\App\Http\Controllers\Admin\BlogController::class, 'uploadImage'])->name('blogs.uploadImage');
    Route::resource('blogs', \App\Http\Controllers\Admin\BlogController::class)->except(['show']);

    // Users
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->except(['show']);

    // Sliders
    Route::resource('sliders', \App\Http\Controllers\Admin\SliderController::class)->except(['show']);

    // Home — About Section
    Route::get('/home-about', [\App\Http\Controllers\Admin\HomeAboutController::class, 'index'])->name('home-about.index');
    Route::get('/home-about/section/edit', [\App\Http\Controllers\Admin\HomeAboutController::class, 'editSection'])->name('home-about.section.edit');
    Route::put('/home-about/section', [\App\Http\Controllers\Admin\HomeAboutController::class, 'updateSection'])->name('home-about.section.update');
    Route::get('/home-about/features/create', [\App\Http\Controllers\Admin\HomeAboutController::class, 'createFeature'])->name('home-about.features.create');
    Route::post('/home-about/features', [\App\Http\Controllers\Admin\HomeAboutController::class, 'storeFeature'])->name('home-about.features.store');
    Route::get('/home-about/features/{feature}/edit', [\App\Http\Controllers\Admin\HomeAboutController::class, 'editFeature'])->name('home-about.features.edit');
    Route::put('/home-about/features/{feature}', [\App\Http\Controllers\Admin\HomeAboutController::class, 'updateFeature'])->name('home-about.features.update');
    Route::delete('/home-about/features/{feature}', [\App\Http\Controllers\Admin\HomeAboutController::class, 'destroyFeature'])->name('home-about.features.destroy');

    // Home — Testimonial Section
    Route::get('/testimonials', [\App\Http\Controllers\Admin\TestimonialController::class, 'index'])->name('testimonials.index');
    Route::get('/testimonials/section/edit', [\App\Http\Controllers\Admin\TestimonialController::class, 'editSection'])->name('testimonials.section.edit');
    Route::put('/testimonials/section', [\App\Http\Controllers\Admin\TestimonialController::class, 'updateSection'])->name('testimonials.section.update');
    Route::get('/testimonials/create', [\App\Http\Controllers\Admin\TestimonialController::class, 'create'])->name('testimonials.create');
    Route::post('/testimonials', [\App\Http\Controllers\Admin\TestimonialController::class, 'store'])->name('testimonials.store');
    Route::get('/testimonials/{testimonial}/edit', [\App\Http\Controllers\Admin\TestimonialController::class, 'edit'])->name('testimonials.edit');
    Route::put('/testimonials/{testimonial}', [\App\Http\Controllers\Admin\TestimonialController::class, 'update'])->name('testimonials.update');
    Route::delete('/testimonials/{testimonial}', [\App\Http\Controllers\Admin\TestimonialController::class, 'destroy'])->name('testimonials.destroy');

    // Home — Trusted Section (Fid Section)
    Route::get('/home-trusted', [\App\Http\Controllers\Admin\HomeTrustedController::class, 'index'])->name('home-trusted.index');
    Route::get('/home-trusted/section/edit', [\App\Http\Controllers\Admin\HomeTrustedController::class, 'editSection'])->name('home-trusted.section.edit');
    Route::put('/home-trusted/section', [\App\Http\Controllers\Admin\HomeTrustedController::class, 'updateSection'])->name('home-trusted.section.update');
    Route::get('/home-trusted/features/create', [\App\Http\Controllers\Admin\HomeTrustedController::class, 'createFeature'])->name('home-trusted.features.create');
    Route::post('/home-trusted/features', [\App\Http\Controllers\Admin\HomeTrustedController::class, 'storeFeature'])->name('home-trusted.features.store');
    Route::get('/home-trusted/features/{feature}/edit', [\App\Http\Controllers\Admin\HomeTrustedController::class, 'editFeature'])->name('home-trusted.features.edit');
    Route::put('/home-trusted/features/{feature}', [\App\Http\Controllers\Admin\HomeTrustedController::class, 'updateFeature'])->name('home-trusted.features.update');
    Route::delete('/home-trusted/features/{feature}', [\App\Http\Controllers\Admin\HomeTrustedController::class, 'destroyFeature'])->name('home-trusted.features.destroy');
    Route::get('/home-trusted/counters/create', [\App\Http\Controllers\Admin\HomeTrustedController::class, 'createCounter'])->name('home-trusted.counters.create');
    Route::post('/home-trusted/counters', [\App\Http\Controllers\Admin\HomeTrustedController::class, 'storeCounter'])->name('home-trusted.counters.store');
    Route::get('/home-trusted/counters/{counter}/edit', [\App\Http\Controllers\Admin\HomeTrustedController::class, 'editCounter'])->name('home-trusted.counters.edit');
    Route::put('/home-trusted/counters/{counter}', [\App\Http\Controllers\Admin\HomeTrustedController::class, 'updateCounter'])->name('home-trusted.counters.update');
    Route::delete('/home-trusted/counters/{counter}', [\App\Http\Controllers\Admin\HomeTrustedController::class, 'destroyCounter'])->name('home-trusted.counters.destroy');

    // Home — CTA Section
    Route::get('/home-cta', [\App\Http\Controllers\Admin\HomeCtaController::class, 'index'])->name('home-cta.index');
    Route::get('/home-cta/edit', [\App\Http\Controllers\Admin\HomeCtaController::class, 'edit'])->name('home-cta.edit');
    Route::put('/home-cta', [\App\Http\Controllers\Admin\HomeCtaController::class, 'update'])->name('home-cta.update');

    // Home — Why Different Section
    Route::get('/home-different', [\App\Http\Controllers\Admin\HomeDifferentController::class, 'index'])->name('home-different.index');
    Route::get('/home-different/section/edit', [\App\Http\Controllers\Admin\HomeDifferentController::class, 'editSection'])->name('home-different.section.edit');
    Route::put('/home-different/section', [\App\Http\Controllers\Admin\HomeDifferentController::class, 'updateSection'])->name('home-different.section.update');
    Route::get('/home-different/tabs/create', [\App\Http\Controllers\Admin\HomeDifferentController::class, 'createTab'])->name('home-different.tabs.create');
    Route::post('/home-different/tabs', [\App\Http\Controllers\Admin\HomeDifferentController::class, 'storeTab'])->name('home-different.tabs.store');
    Route::get('/home-different/tabs/{tab}/edit', [\App\Http\Controllers\Admin\HomeDifferentController::class, 'editTab'])->name('home-different.tabs.edit');
    Route::put('/home-different/tabs/{tab}', [\App\Http\Controllers\Admin\HomeDifferentController::class, 'updateTab'])->name('home-different.tabs.update');
    Route::delete('/home-different/tabs/{tab}', [\App\Http\Controllers\Admin\HomeDifferentController::class, 'destroyTab'])->name('home-different.tabs.destroy');

    // Home — Video Banner Section
    Route::get('/home-video-banner', [\App\Http\Controllers\Admin\HomeVideoBannerController::class, 'index'])->name('home-video-banner.index');
    Route::get('/home-video-banner/edit', [\App\Http\Controllers\Admin\HomeVideoBannerController::class, 'edit'])->name('home-video-banner.edit');
    Route::put('/home-video-banner', [\App\Http\Controllers\Admin\HomeVideoBannerController::class, 'update'])->name('home-video-banner.update');
    Route::delete('/home-video-banner/remove-logo', [\App\Http\Controllers\Admin\HomeVideoBannerController::class, 'removeCustomLogo'])->name('home-video-banner.remove-logo');
    Route::delete('/home-video-banner/remove-background', [\App\Http\Controllers\Admin\HomeVideoBannerController::class, 'removeBackground'])->name('home-video-banner.remove-background');
});
