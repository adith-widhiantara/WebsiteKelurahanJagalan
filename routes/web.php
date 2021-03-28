<?php

namespace App;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Warga\AduanController;
use App\Http\Controllers\Admin\AdminNewsController;
use App\Http\Controllers\Warga\News\NewsController;
use App\Http\Controllers\Admin\Aduan\TolakController;
use App\Http\Controllers\Admin\Aduan\ValidController;
use App\Http\Controllers\Warga\News\CategoryController;
use App\Http\Controllers\Admin\Aduan\TindakLanjutController;
use App\Http\Controllers\Admin\AduanController as AdminAduanController;

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

// aduan
Route::prefix('aduan')->name('aduan.')->middleware('auth')->group(function () {
    // index
    Route::get('', [AduanController::class, 'index'])->name('index'); // aduan.index

    // create
    Route::get('create', [AduanController::class, 'create'])->name('create'); // aduan.create

    // store
    Route::post('store', [AduanController::class, 'store'])->name('store'); // aduan.store

    // show
    Route::get('{aduan:slug}', [AduanController::class, 'show'])->name('show'); // aduan.show

    // store comment
    Route::post('{aduan:slug}/comment', [AduanController::class, 'comment'])->name('comment'); // aduan.comment
});
// end aduan

// admin
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // landing
    Route::middleware('role:admin|petugas|RW|kepala_kelurahan')->group(function () {
        // index
        Route::view('', 'page.admin.landing.index')->name('index');
    });
    // end landing

    // news
    Route::prefix('news')->name('news.')->middleware('role:admin|petugas|RW|kepala_kelurahan')->group(function () {
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
    // end news

    // news category
    Route::prefix('category')->name('category.')->middleware('role:admin|petugas|RW|kepala_kelurahan')->group(function () {
        // index
        Route::get('', [AdminNewsController::class, 'indexCategory'])->name('index');

        // store
        Route::post('', [AdminNewsController::class, 'storeCategory'])->name('store');

        // put
        Route::put('update/{category:slug}', [AdminNewsController::class, 'updateCategory'])->name('put');

        // show
        Route::get('detail/{category:slug}', [AdminNewsController::class, 'showCategory'])->name('show');
    });
    // end news category

    // Aduan
    Route::prefix('aduan')->name('aduan.')->middleware('role:admin|petugas|RW|kepala_kelurahan')->group(function () {
        // index
        Route::get('', [AdminAduanController::class, 'index'])->name('index'); // admin.aduan.index

        // index Bulan Ini
        Route::get('bulanini', [AdminAduanController::class, 'thisMonthIndex'])->name('thisMonthIndex'); // admin.aduan.thisMonthIndex

        // store jenis aduan
        Route::post('store', [AdminAduanController::class, 'storeJenisAduan'])->name('storeJenisAduan'); // admin.aduan.storeJenisAduan

        // show aduan
        Route::get('detail/{aduan:slug}', [AdminAduanController::class, 'show'])->name('show'); // admin.aduan.show

        // timeline show aduan
        Route::get('detail/{aduan:slug}/timeline', [AdminAduanController::class, 'timeline'])->name('timeline'); // admin.aduan.timeline

        // update jenis aduan
        Route::put('put/{jenis_aduan:slug}', [AdminAduanController::class, 'updateJenisAduan'])->name('updateJenisAduan'); // admin.aduan.updateJenisAduan

        // tolak aduan group
        Route::prefix('tolak')->name('tolak.')->group(function () {
            // store
            Route::post('{aduan:slug}/store', [TolakController::class, 'store'])->name('store'); // admin.aduan.tolak.store
        });

        // valid aduan group
        Route::prefix('valid/{aduan:slug}')->name('valid.')->group(function () {
            // store
            Route::post('store', [ValidController::class, 'store'])->name('store'); // admin.aduan.valid.store
        });

        // tindak lanjut aduan group
        Route::prefix('tindaklanjut')->name('tindaklanjut.')->group(function () {
            // index
            Route::get('', [TindakLanjutController::class, 'index'])->withoutMiddleware('role:petugas|kepala_kelurahan')->name('index'); // admin.aduan.tindaklanjut.index

            // store
            Route::post('{aduan:slug}', [TindakLanjutController::class, 'store'])->withoutMiddleware('role:petugas|kepala_kelurahan')->name('store'); // admin.aduan.tindaklanjut.store

            // upload foto bukti rw
            Route::put('put/{aduan:slug}', [TindakLanjutController::class, 'put'])->withoutMiddleware('role:petugas|kepala_kelurahan')->name('put'); // admin.aduan.tindaklanjut.put

            // comment kepala kelurahan
            Route::post('comment/{aduan:slug}', [TindakLanjutController::class, 'commentKepalaKelurahan'])->name('commentKepalaKelurahan'); // admin.aduan.tindaklanjut.commentKepalaKelurahan
        });
    });
    // end Aduan
});
// end admin

// auth
require __DIR__ . '/auth.php';
// end auth
