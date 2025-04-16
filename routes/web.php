<?php

use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', function () { return view('pages.auth.login'); })->name('login');

    Route::get('/register', function () {
        return view('pages.auth.registrasi');
    })->name('register');
    

    Route::prefix('auth')->name('auth.')->group(function () {
        Route::post('login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
        Route::post('register', [App\Http\Controllers\AuthController::class, 'register'])->name('register');
    });
});

Route::middleware(['auth', 'check-access', 'authorize-access'])->group(function () {
    Route::get('beranda', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('menu/get-data-all', [App\Http\Controllers\MenuController::class, 'getDataAll'])->name('menu.get-data-all');
    Route::resource('menu', App\Http\Controllers\MenuController::class);
    
    Route::get('test', [App\Http\Controllers\UserExtrasController::class, 'index'])->name('user_extras');
    Route::post('user_extras', [App\Http\Controllers\UserExtrasController::class, 'store'])->name('user_extras.store');
});

Route::post('logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('auth.logout');

