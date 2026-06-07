<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteSettingController;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $portfolios = \App\Models\Portfolio::all();
    $settings = SiteSetting::getSettings();
    return view('welcome', compact('portfolios', 'settings'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Admin Routes
    Route::resource('admin/portfolios', \App\Http\Controllers\PortfolioController::class);
    Route::get('admin/settings', [SiteSettingController::class, 'edit'])->name('admin.settings.edit');
    Route::put('admin/settings', [SiteSettingController::class, 'update'])->name('admin.settings.update');
});

require __DIR__.'/auth.php';
