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
use App\Http\Controllers\PagesController;


use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\AdminBlogsController;
use App\Http\Controllers\Admin\AdminCategoryController;

use App\Http\Controllers\Admin\AdminPrivacyController;
use App\Http\Controllers\Admin\AdminTermsController;
use App\Http\Controllers\Admin\AdminAboutController;
use App\Http\Controllers\Admin\AdminDisclaimerController;

use App\Http\Controllers\Admin\AdminSettingsController;
use App\Http\Controllers\Admin\AdminProfileController;



Route::get('/', [WelcomeController::class, 'index']);
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/blogs/category/{slug}', [BlogController::class, 'category'])->name('blogs.category');
Route::get('/search', [BlogController::class, 'search'])->name('search');

Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::get('/help', [HelpController::class, 'index'])->name('help');
Route::get('/privacy', [PrivacyController::class, 'index'])->name('privacy.index');
Route::get('/terms', [TermsController::class, 'index'])->name('terms.index');
Route::get('/about', [PagesController::class, 'about'])->name('about.us.index');
Route::get('/disclaimer', [PagesController::class, 'disclaimer'])->name('disclaimer.index');




Route::post('/subscribe', [SubscriberController::class, 'subscribe'])->name('newsletter.subscribe');
Route::post('/savecontact', [ContactController::class, 'store'])->name('savecontact');


Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/admin/blogs', [AdminBlogsController::class, 'index'])->name('admin.blogs.index');
Route::get('/admin/blog/create', [AdminBlogsController::class, 'create'])->name('admin.blog.create');
Route::post('/admin/blog/store', [AdminBlogsController::class, 'store'])->name('admin.blog.store');
Route::get('/admin/blogs/show/{id}', [AdminBlogsController::class, 'show'])->name('admin.blogs.show');
Route::get('/admin/blogs/edit/{id}', [AdminBlogsController::class, 'edit'])->name('admin.blogs.edit');
Route::put('/admin/blogs/update/{id}', [AdminBlogsController::class, 'update'])->name('admin.blogs.update');
Route::delete('/admin/blogs/delete/{id}', [AdminBlogsController::class, 'destroy'])->name('admin.blogs.destroy');

Route::get('/admin/category', [AdminCategoryController::class, 'index'])->name('admin.category.index');
Route::get('/admin/category/create', [AdminCategoryController::class, 'create'])->name('admin.category.create');
Route::post('/admin/category/store', [AdminCategoryController::class, 'store'])->name('admin.category.store');
Route::get('/admin/category/show/{id}', [AdminCategoryController::class, 'show'])->name('admin.category.show');
Route::get('/admin/category/edit/{id}', [AdminCategoryController::class, 'edit'])->name('admin.category.edit');
Route::put('/admin/category/update/{id}', [AdminCategoryController::class, 'update'])->name('admin.category.update');
Route::delete('/admin/category/delete/{id}', [AdminCategoryController::class, 'destroy'])->name('admin.category.destroy');

Route::get('/admin/privacy', [AdminPrivacyController::class, 'index'])->name('admin.pages.privacy');
Route::put('/admin/privacy/update/{id}', [AdminPrivacyController::class, 'update'])->name('admin.privacy.update');

Route::get('/admin/terms', [AdminTermsController::class, 'index'])->name('admin.pages.terms');
Route::put('/admin/terms/update/{id}', [AdminTermsController::class, 'update'])->name('admin.terms.update');

Route::get('/admin/about', [AdminAboutController::class, 'index'])->name('admin.pages.about');
Route::put('/admin/about/update/{id}', [AdminAboutController::class, 'update'])->name('admin.about.update');

Route::get('/admin/disclaimer', [AdminDisclaimerController::class, 'index'])->name('admin.pages.disclaimer');
Route::put('/admin/disclaimer/update/{id}', [AdminDisclaimerController::class, 'update'])->name('admin.disclaimer.update');

Route::get('/admin/settings', [AdminSettingsController::class, 'index'])->name('admin.settings.index');
Route::post('/admin/settings/update', [AdminSettingsController::class, 'update'])->name('admin.settings.update');

Route::get('/admin/profile', [AdminProfileController::class, 'index'])->name('admin.profile.index');
