<?php

use App\Http\Controllers\LibraryController;
use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LibraryController::class, 'index'])->name('home');
Route::get('/catalog', [LibraryController::class, 'catalog'])->name('catalog');
Route::middleware('guest')->group(function () {
    Route::get('/login', [LibraryController::class, 'login'])->name('login');
    Route::post('/login', [AccountController::class, 'login'])->middleware('throttle:5,1')->name('login.store');
    Route::get('/register', [LibraryController::class, 'register'])->name('register');
    Route::post('/register', [AccountController::class, 'register'])->name('register.store');
});

Route::post('/logout', [AccountController::class, 'logout'])->middleware('auth')->name('logout');
