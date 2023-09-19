<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::prefix('guide')->group(function () {
    Route::get('eng', [GuideController::class, 'guide_english']);
});

Route::prefix('auth')->group(function () {
    Route::get('register', [AuthController::class, 'indexRegister'])->name('register.index');
    Route::post('register', [AuthController::class, 'register'])->name('register.post');
    Route::get('login', [AuthController::class, 'indexLogin'])->name('login.index');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');    
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/', [HomeController::class, 'index'])->name('home.index');
// Route::middleware(['auth','web'])->group(function () {
// });

// Route::get('/', function () {
//     if (Session::get('user')) {
//         return redirect()->route('home.index');
//     } else {
//         return view('auth.login');
//     }
// });
