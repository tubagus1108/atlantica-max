<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DownloadsController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemMallController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('locale/{locale}', function ($locale) {
    \Session::put('locale', $locale);
    // dd(app()->getLocale());
    return redirect()->back();
});

Route::prefix('guide')->group(function () {
    Route::get('eng', [GuideController::class, 'guide_english'])->name('guide.eng');
});
Route::get('downloads', [DownloadsController::class, 'index'])->name('downloads');
Route::prefix('auth')->group(function () {
    Route::get('register', [AuthController::class, 'indexRegister'])->name('register.index');
    Route::post('register', [AuthController::class, 'register'])->name('register.post');
    Route::get('login', [AuthController::class, 'indexLogin'])->name('login.index');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::prefix('user')->group(function () {
    Route::get('information', [UserController::class, 'information'])->name('user.information');
    Route::get('reset-password', [UserController::class, 'showResetForm'])->name('reset-password');
    Route::post('reset-password', [UserController::class, 'resetPassword'])->name('reset-password.post');
    Route::get('reset-password-form', [UserController::class, 'showResetPasswordForm'])->name('reset-password-form');
});

Route::prefix('ranking')->group(function () {
    Route::get('characters', [RankingController::class, 'getCharacters'])->name('characters');
    Route::get('characters/detail/{id}', [RankingController::class, 'getCharactersDetail'])->name('characters.detail');
    Route::get('characters/datatable', [RankingController::class, 'getCharactersDatatable'])->name('characters.datatable');

    Route::get('guilds', [RankingController::class, 'getGuilds'])->name('guilds');
    Route::get('guilds/detail/{id}', [RankingController::class, 'getGuildsDetail'])->name('guilds.detail');
    Route::get('guilds/datatable', [RankingController::class, 'getGuildsDatatable'])->name('guilds.datatable');
});
Route::prefix('item')->group(function () {
    Route::get('', [ItemMallController::class, 'index'])->name('item-mall');
    Route::get('{category_id}', [ItemMallController::class, 'GetCategoryProduct']);
    Route::post('/purchase', [ItemMallController::class, 'purchase'])->name('purchase');
});
Route::middleware(['admin.check'])->group(function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('dashboard', function () {
            dd("HALAMAN DASHBOARD");
        })->name('admin.dashboard');
    });
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
