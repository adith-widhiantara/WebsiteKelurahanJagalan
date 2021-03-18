<?php

namespace App;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\News\NewsController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminNewsController;
use App\Http\Controllers\News\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', LandingController::class)->name('landing');

// User
Route::prefix('user')->name('user.')->group(function () {
    // show
    Route::get('{user}', [UserController::class, 'show'])->name('show');
});
// end User

// News
Route::prefix('news')->name('news.')->group(function () {
    // index
    Route::get('', [NewsController::class, 'index'])->name('index');

    // show
    Route::get('{news:slug}', [NewsController::class, 'show'])->name('show');
});
// end News

// category
Route::prefix('category')->name('category.')->group(function () {
    // show
    Route::get('{category:slug}', [CategoryController::class, 'show'])->name('show');
});
// end category

// admin
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    // landing
    Route::middleware('role:admin|petugas')->group(function () {
        // index
        Route::get('', [AdminController::class, 'index'])->name('index');
    });
    // end landing

    // news
    Route::prefix('news')->name('news.')->group(function () {
        Route::middleware('role:admin|petugas')->group(function () {
            // index
            Route::get('', [AdminNewsController::class, 'index'])->name('index');

            // create
            Route::get('create', [AdminNewsController::class, 'createNews'])->name('create');

            // store
            Route::post('create', [AdminNewsController::class, 'storeNews'])->name('store');

            // show
            Route::get('detail/{news:slug}', [AdminNewsController::class, 'showNews'])->name('show');

            // put
            Route::put('put/{news:slug}', [AdminNewsController::class, 'putNews'])->name('put');

            // hide news
            Route::put('hide/{news:slug}', [AdminNewsController::class, 'hideNews'])->name('hide');

            // show news
            Route::put('show/{news:slug}', [AdminNewsController::class, 'showNewsPut'])->name('showPut');
        });
    });
    // end news

    // news category
    Route::prefix('category')->name('category.')->group(function () {
        Route::middleware('role:admin|petugas')->group(function () {
            // index
            Route::get('', [AdminNewsController::class, 'indexCategory'])->name('index');

            // store
            Route::post('', [AdminNewsController::class, 'storeCategory'])->name('store');

            // put
            Route::put('update/{category:slug}', [AdminNewsController::class, 'updateCategory'])->name('put');

            // show
            Route::get('detail/{category:slug}', [AdminNewsController::class, 'showCategory'])->name('show');
        });
    });
    // end news category
});
// end admin

// auth
require __DIR__ . '/auth.php';
// end auth
