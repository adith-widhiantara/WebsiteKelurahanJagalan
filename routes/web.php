<?php

namespace App;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\News\NewsController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
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
    Route::get('{user}', [UserController::class, 'show'])->name('show');
});
// end User

// News
Route::prefix('news')->name('news.')->group(function () {
    Route::get('', [NewsController::class, 'index'])->name('index');
    Route::get('{news:slug}', [NewsController::class, 'show'])->name('show');
});
// end News

// category
Route::prefix('categories')->name('category.')->group(function () {
    Route::get('{category:slug}', [CategoryController::class, 'show'])->name('show');
});
// end category

// admin
Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('', [AdminController::class, 'index'])->name('index');
});
// end admin

// auth
require __DIR__ . '/auth.php';
// end auth
