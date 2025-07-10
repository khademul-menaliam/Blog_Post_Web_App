<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;

use App\Http\Controllers\HelpController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\AdminBlogsController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminPrivacyController;
use App\Http\Controllers\Admin\AdminTermsController;
use App\Http\Controllers\Admin\AdminSettingsController;
use App\Http\Controllers\Admin\AdminProfileController;










Route::get('/', [WelcomeController::class, 'index']);
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/blogs/category/{slug}', [BlogController::class, 'category'])->name('blogs.category');
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::get('/help', [HelpController::class, 'index'])->name('help');
Route::get('/privacy', [PrivacyController::class, 'index'])->name('privacy.index');
Route::get('/terms', [TermsController::class, 'index'])->name('terms.index');

// Route::post('/subscribe', [SubscriberController::class, 'store'])->name('newsletter.subscribe');
Route::post('/subscribe', [SubscriberController::class, 'subscribe'])->name('newsletter.subscribe');
// Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::post('/savecontact', [ContactController::class, 'store'])->name('savecontact');


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/admin/blogs', [AdminBlogsController::class, 'index'])->name('admin.blogs.index');
Route::get('/admin/blog/create', [AdminBlogsController::class, 'create'])->name('admin.blog.create');
Route::get('/admin/blogs/show/{id}', [AdminBlogsController::class, 'show'])->name('admin.blogs.show');


Route::get('/admin/category', [AdminCategoryController::class, 'index'])->name('admin.category.index');
Route::get('/admin/category/create', [AdminCategoryController::class, 'create'])->name('admin.category.create');

Route::get('/admin/privacy', [AdminPrivacyController::class, 'index'])->name('admin.pages.privacy');
Route::get('/admin/terms', [AdminTermsController::class, 'index'])->name('admin.pages.terms');

Route::get('/admin/settings', [AdminSettingsController::class, 'index'])->name('admin.settings.index');

Route::get('/admin/profile', [AdminProfileController::class, 'index'])->name('admin.profile.index');
