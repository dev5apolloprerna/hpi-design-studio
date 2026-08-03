<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PhotoGalleryController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\VideoGalleryController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin/login');

Route::prefix('admin')->name('admin.')->group(function () {

    // Guest only routes
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('login', [AuthController::class, 'login'])->name('login.submit');
    });

    // Authenticated admin routes
    Route::middleware('auth')->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('profile/change-password', [ProfileController::class, 'edit'])->name('profile.change-password');
        Route::put('profile/change-password', [ProfileController::class, 'update'])->name('profile.update-password');

        Route::resource('categories', CategoryController::class)->except(['show']);
        Route::resource('photo-gallery', PhotoGalleryController::class)->except(['show']);
        Route::resource('video-gallery', VideoGalleryController::class)->except(['show']);
        Route::resource('testimonials', TestimonialController::class)->except(['show']);
    });
});
