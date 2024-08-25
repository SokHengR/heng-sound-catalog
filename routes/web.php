<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SoundController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Home route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Sound routes
Route::get('/sounds', [SoundController::class, 'index'])->name('sounds.index');
Route::get('/sounds/search', [SoundController::class, 'search'])->name('sounds.search');
Route::post('/sounds/{id}/complain', [ComplaintController::class, 'store'])->name('sounds.complain');
Route::post('/sounds/upload', [SoundController::class, 'store'])->middleware('auth')->name('sounds.upload');
Route::get('/sounds/download/{id}', [SoundController::class, 'download'])->name('sounds.download');

// Admin routes with middleware
Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::post('/sounds/{id}/approve', [AdminController::class, 'approveSound'])->name('sounds.approve');
    Route::delete('/sounds/{id}', [AdminController::class, 'deleteSound'])->name('sounds.delete');
    Route::post('/users/{id}/ban', [AdminController::class, 'banUser'])->name('users.ban');
});

// Authentication routes
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Include authentication routes
require __DIR__.'/auth.php';
