<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SetupController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Safe Database Migration & Table Setup Route (Does NOT delete existing data)
Route::get('/setup-database', [SetupController::class, 'setup'])->name('setup.database');

// Public Frontend Routes (100% Same UI as HTML Template)
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/about-us', [FrontendController::class, 'about']);
Route::get('/service', [FrontendController::class, 'service'])->name('service');
Route::get('/services', [FrontendController::class, 'service']);
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::get('/contact-us', [FrontendController::class, 'contact']);
Route::post('/contact', [FrontendController::class, 'contactSubmit'])->name('contact.submit');

// Blogs Frontend Routes (Active Blogs Only)
Route::get('/blogs', [FrontendController::class, 'blogs'])->name('blogs');
Route::get('/blog/{slug}', [FrontendController::class, 'blogDetail'])->name('blog.detail');

// Admin Authentication Routes
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Protected Admin Panel Routes
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index']);
    
    // Analytics & Visitor Tab
    Route::get('/analytics', [DashboardController::class, 'analytics'])->name('analytics');
    
    // Blog Management
    Route::resource('blogs', BlogController::class);
    Route::post('blogs/{blog}/toggle-status', [BlogController::class, 'toggleStatus'])->name('blogs.toggle');

    // Contact Inquiries
    Route::resource('contacts', ContactController::class)->only(['index', 'show', 'destroy']);
});
