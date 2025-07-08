<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;

use App\Http\Controllers\HelpController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\TermsController;






Route::get('/', [WelcomeController::class, 'index']);

Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/blogs/category/{slug}', [BlogController::class, 'category'])->name('blogs.category');
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');


Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');

Route::get('/help', [HelpController::class, 'index'])->name('help');

Route::get('/privacy', [PrivacyController::class, 'index'])->name('privacy.index');
Route::get('/terms', [TermsController::class, 'index'])->name('terms.index');



// Route::get('/blog/create', [BlogController::class, 'create'])->name('blog.create'); // Show create form
// Route::post('/blog', [BlogController::class, 'store'])->name('blog.store');         // Store new blog
// Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog.show');         // Display single blog
// Route::get('/blog/{id}/edit', [BlogController::class, 'edit'])->name('blog.edit');    // Show edit form
// Route::put('/blog/{id}', [BlogController::class, 'update'])->name('blog.update');       // Update blog
// Route::delete('/blog/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');  // Delete blog
