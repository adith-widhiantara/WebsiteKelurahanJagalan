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
    // index
    Route::view('', 'page.admin.landing.index')->middleware('role:admin|petugas|RW|kepala_kelurahan')->name('index');
    // end landing

    // news
    Route::prefix('news')->name('news.')->group(function () {
        // index
        Route::get('', [AdminNewsController::class, 'index'])->middleware('role:admin|petugas|RW|kepala_kelurahan')->name('index');

        // create
        Route::get('create', [AdminNewsController::class, 'createNews'])->middleware('role:admin|petugas|RW|kepala_kelurahan')->name('create');

        // store
        Route::post('create', [AdminNewsController::class, 'storeNews'])->middleware('role:admin|petugas|RW|kepala_kelurahan')->name('store');

        // show
        Route::get('detail/{news:slug}', [AdminNewsController::class, 'showNews'])->middleware('role:admin|petugas|RW|kepala_kelurahan')->name('show');

        // put
        Route::put('put/{news:slug}', [AdminNewsController::class, 'putNews'])->middleware('role:admin|petugas|RW|kepala_kelurahan')->name('put');

        // hide news
        Route::put('hide/{news:slug}', [AdminNewsController::class, 'hideNews'])->middleware('role:admin|petugas|RW|kepala_kelurahan')->name('hide');

        // show news
        Route::put('show/{news:slug}', [AdminNewsController::class, 'showNewsPut'])->middleware('role:admin|petugas|RW|kepala_kelurahan')->name('showPut');
    });
    // end news

    // news category
    Route::prefix('category')->name('category.')->group(function () {
        // index
        Route::get('', [AdminNewsController::class, 'indexCategory'])->middleware('role:admin|petugas|RW|kepala_kelurahan')->name('index');

        // store
        Route::post('', [AdminNewsController::class, 'storeCategory'])->middleware('role:admin|petugas|RW|kepala_kelurahan')->name('store');

        // put
        Route::put('update/{category:slug}', [AdminNewsController::class, 'updateCategory'])->middleware('role:admin|petugas|RW|kepala_kelurahan')->name('put');

        // show
        Route::get('detail/{category:slug}', [AdminNewsController::class, 'showCategory'])->middleware('role:admin|petugas|RW|kepala_kelurahan')->name('show');
    });
    // end news category

    // Aduan
    Route::prefix('aduan')->name('aduan.')->group(function () {
        // index
        Route::get('', [AdminAduanController::class, 'index'])->middleware('role:admin|petugas|RW|kepala_kelurahan')->name('index'); // admin.aduan.index

        // index Bulan Ini
        Route::get('bulanini', [AdminAduanController::class, 'thisMonthIndex'])->middleware('role:admin|petugas|RW|kepala_kelurahan')->name('thisMonthIndex'); // admin.aduan.thisMonthIndex

        // store jenis aduan
        Route::post('store', [AdminAduanController::class, 'storeJenisAduan'])->middleware('role:admin|petugas|RW|kepala_kelurahan')->name('storeJenisAduan'); // admin.aduan.storeJenisAduan

        // show aduan
        Route::get('detail/{aduan:slug}', [AdminAduanController::class, 'show'])->middleware('role:admin|petugas|RW|kepala_kelurahan')->name('show'); // admin.aduan.show

        // timeline show aduan
        Route::get('detail/{aduan:slug}/timeline', [AdminAduanController::class, 'timeline'])->middleware('role:admin|petugas|RW|kepala_kelurahan')->name('timeline'); // admin.aduan.timeline

        // update jenis aduan
        Route::put('put/{jenis_aduan:slug}', [AdminAduanController::class, 'updateJenisAduan'])->middleware('role:admin|petugas|RW|kepala_kelurahan')->name('updateJenisAduan'); // admin.aduan.updateJenisAduan

        // tolak aduan store
        Route::post('tolak/{aduan:slug}/store', [TolakController::class, 'store'])->middleware('role:admin|petugas|RW|kepala_kelurahan')->name('tolak.store'); // admin.aduan.tolak.store

        // store
        Route::post('valid/{aduan:slug}/store', [ValidController::class, 'store'])->middleware('role:admin|petugas|RW|kepala_kelurahan')->name('valid.store'); // admin.aduan.valid.store

        // tindak lanjut aduan group
        Route::prefix('tindaklanjut')->name('tindaklanjut.')->group(function () {
            // index
            Route::get('', [TindakLanjutController::class, 'index'])->middleware('role:admin|petugas|RW|kepala_kelurahan')->name('index'); // admin.aduan.tindaklanjut.index

            // store
            Route::post('{aduan:slug}', [TindakLanjutController::class, 'store'])->middleware('role:RW')->name('store'); // admin.aduan.tindaklanjut.store

            // upload foto bukti rw
            Route::put('put/{aduan:slug}', [TindakLanjutController::class, 'put'])->middleware('role:RW')->name('put'); // admin.aduan.tindaklanjut.put

            // comment kepala kelurahan
            Route::post('comment/{aduan:slug}', [TindakLanjutController::class, 'commentKepalaKelurahan'])->middleware('role:kepala_kelurahan')->name('commentKepalaKelurahan'); // admin.aduan.tindaklanjut.commentKepalaKelurahan
        });
    });
    // end Aduan
});
// end admin

// auth
require __DIR__ . '/auth.php';
// end auth
