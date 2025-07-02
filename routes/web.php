<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WebAuthController;

// Redirect root to books.index
Route::get('/', fn () => redirect()->route('books.index'));

// Authentication routes accessible only to guests (not logged in)
Route::middleware('guest')->group(function () {
    Route::get('/login', [WebAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [WebAuthController::class, 'login'])->name('login.submit');

    Route::get('/register', [WebAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [WebAuthController::class, 'register'])->name('register.submit');
});

// Logout route accessible only to authenticated users
Route::middleware('auth')->post('/logout', [WebAuthController::class, 'logout'])->name('logout');

// Protect CRUD routes with auth middleware
Route::middleware('auth')->group(function () {
    Route::resource('authors', AuthorController::class);
    Route::resource('books', BookController::class);
    Route::resource('genres', GenreController::class);
    Route::resource('reviews', ReviewController::class);
});
