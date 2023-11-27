<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CashController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DownloadsController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemMallController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\TroubleshootingController;
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

Route::get('news', [NewsController::class, 'index']);
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
Route::get('person', [PersonController::class, 'index'])->name('person.index');
Route::prefix('user')->group(function () {
    Route::get('information', [UserController::class, 'information'])->name('user.information');
    Route::get('reset-password', [UserController::class, 'showResetForm'])->name('reset.password');
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
Route::get('troubleshooting', [TroubleshootingController::class, 'index'])->name('troubleshooting');
Route::middleware(['admin.check'])->group(function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('news', [AdminController::class, 'newsIndex'])->name('admin.news');
        Route::post('news/store', [AdminController::class, 'store'])->name('news.store');
        Route::get('news/datatable', [NewsController::class, 'datatable_news'])->name('datatable.news');
        Route::get('news/delete/{id}', [NewsController::class, 'deleted'])->name('news.deleted');
        Route::get('news/edit/{id}', [NewsController::class, 'editForm'])->name('ajax.news-edit');
        Route::post('news/edit/{id}', [NewsController::class, 'editFormPost'])->name('ajax.news-edit.post');



        Route::middleware(['super_admin.check'])->group(function () {
            Route::get('product', [ProductController::class, 'index'])->name('product.index');
            Route::post('product/store', [ProductController::class, 'store'])->name('product.store');

            Route::get('cash', [CashController::class, 'index'])->name('cash.index');
            Route::post('cash/store', [CashController::class, 'store'])->name('cash.store');
        });
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
