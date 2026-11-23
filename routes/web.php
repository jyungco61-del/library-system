<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LibraryCardController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/books');


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->middleware('no.double');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');


Route::middleware(['auth', 'no.double'])->group(function () {
    Route::resource('authors', AuthorController::class)->only(['index', 'store']);
    Route::resource('categories', CategoryController::class)->only(['index', 'store']);
    Route::resource('books', BookController::class)->only(['index', 'store']);
    Route::resource('members', MemberController::class)->only(['index', 'store']);
    Route::resource('library-cards', LibraryCardController::class)->only(['index', 'store']);
});