<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\UserController;
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
Route::prefix('user')->group(function(){
    Route::get('information',[UserController::class,'information'])->name('user.information');
}); 

Route::prefix('ranking')->group(function(){
    Route::get('characters',[RankingController::class,'getCharacters'])->name('characters');
    Route::get('characters/detail/{id}',[RankingController::class,'getCharactersDetail'])->name('characters.detail');
    Route::get('characters/datatable',[RankingController::class,'getCharactersDatatable'])->name('characters.datatable');

    Route::get('guilds',[RankingController::class,'getGuilds'])->name('guilds');
    Route::get('guilds/detail/{id}',[RankingController::class,'getGuildsDetail'])->name('guilds.detail');
    Route::get('guilds/datatable',[RankingController::class,'getGuildsDatatable'])->name('guilds.datatable');
});
// Route::middleware(['auth','web'])->group(function () {
// });

// Route::get('/', function () {
//     if (Session::get('user')) {
//         return redirect()->route('home.index');
//     } else {
//         return view('auth.login');
//     }
// });
