<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\SiteSetting;
use App\Models\Portfolio;
use App\Models\Testimonial;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $portfolios = Portfolio::all();
    $settings = SiteSetting::getSettings();
    $testimonials = Testimonial::where('is_visible', true)->get();
    $posts = Post::where('status', 'published')->latest()->take(3)->get();
    return view('welcome', compact('portfolios', 'settings', 'testimonials', 'posts'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Public order and invoice routes
Route::post('/order', [OrderController::class, 'store'])->name('order.store');
Route::get('/invoice/{invoice_number}', [OrderController::class, 'showInvoice'])->name('invoice.show');
Route::get('/blog/{slug}', [PostController::class, 'showPublic'])->name('blog.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Admin Routes
    Route::resource('admin/portfolios', \App\Http\Controllers\PortfolioController::class);
    Route::get('admin/settings', [SiteSettingController::class, 'edit'])->name('admin.settings.edit');
    Route::put('admin/settings', [SiteSettingController::class, 'update'])->name('admin.settings.update');
    
    // Admin Order Management
    Route::get('admin/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('admin/orders/{id}', [OrderController::class, 'show'])->name('admin.orders.show');
    Route::put('admin/orders/{id}', [OrderController::class, 'update'])->name('admin.orders.update');

    // Admin Testimonials (CMS)
    Route::resource('admin/testimonials', TestimonialController::class)->only(['index', 'store', 'destroy']);

    // Admin Blog (CMS)
    Route::resource('admin/posts', PostController::class)->except(['show']);

    // Admin User Management
    Route::get('admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::post('admin/users', [UserController::class, 'store'])->name('admin.users.store');
});

require __DIR__.'/auth.php';
