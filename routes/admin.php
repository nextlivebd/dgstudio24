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
    Route::get('/pages/{id}/edit', [PageController::class, 'edit'])->name('pages.edit');
    Route::put('/pages/{id}', [PageController::class, 'update'])->name('pages.update');
    
    // Site Settings
    Route::get('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
    
    // Contacts (Frontend submissions)
    Route::get('/contacts', [\App\Http\Controllers\Admin\ContactController::class, 'index'])->name('contacts.index');

    // Office Contact Informations
    Route::resource('contact-informations', \App\Http\Controllers\Admin\ContactInformationController::class)->except(['show']);

    // Categories
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class)->except(['show']);

    // Blogs
    Route::post('blogs/upload-image', [\App\Http\Controllers\Admin\BlogController::class, 'uploadImage'])->name('blogs.uploadImage');
    Route::resource('blogs', \App\Http\Controllers\Admin\BlogController::class)->except(['show']);

    // Users
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->except(['show']);
});
