<?php

namespace App;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Warga\AduanController;
use App\Http\Controllers\Warga\News\NewsController;
use App\Http\Controllers\Admin\Aduan\TolakController;
use App\Http\Controllers\Admin\Aduan\ValidController;
use App\Http\Controllers\Admin\Surat\SuratController;
use App\Http\Controllers\Warga\News\CategoryController;
use App\Http\Controllers\Admin\News\AdminNewsController;
use App\Http\Controllers\Admin\Surat\JenisSuratController;
use App\Http\Controllers\Admin\Aduan\TindakLanjutController;
use App\Http\Controllers\Admin\KartuKeluarga\KartuKeluargaController;
use App\Http\Controllers\Admin\PengaturanWarga\PindahMasukController;
use App\Http\Controllers\Admin\PengaturanWarga\DataKematianController;
use App\Http\Controllers\Admin\PengaturanWarga\PindahKeluarController;
use App\Http\Controllers\Admin\KartuKeluarga\AnggotaKeluargaController;
use App\Http\Controllers\Admin\PengaturanWarga\DataKelahiranController;
use App\Http\Controllers\Admin\KartuKeluarga\TabelKartuKeluargaController;
use App\Http\Controllers\Admin\Aduan\AduanController as AdminAduanController;

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

    // Kartu Keluarga
    Route::prefix('kartukeluarga')->name('kartukeluarga.')->group(function () {
        // index
        Route::get('', [KartuKeluargaController::class, 'index'])->name('index'); // admin.kartukeluarga.index

        // create
        Route::get('create', [KartuKeluargaController::class, 'create'])->name('create'); // admin.kartukeluarga.create

        // store
        Route::post('', [KartuKeluargaController::class, 'store'])->name('store'); // admin.kartukeluarga.store

        // show
        Route::get('{kartuKeluarga:nomorkk}', [KartuKeluargaController::class, 'show'])->name('show'); // admin.kartukeluarga.show

        // update
        Route::put('{kartuKeluarga:nomorkk}', [KartuKeluargaController::class, 'update'])->name('update'); // admin.kartukeluarga.update
    });
    // end Kartu Keluarga

    // anggota keluarga
    Route::prefix('kartukeluarga/{kartuKeluarga:nomorkk}')->name('kartukeluarga.anggota.')->group(function () {
        // create
        Route::get('create', [AnggotaKeluargaController::class, 'create'])->name('create'); // admin.kartukeluarga.anggota.create

        // store
        Route::post('', [AnggotaKeluargaController::class, 'store'])->name('store'); // admin.kartukeluarga.anggota.store

        // show
        Route::get('{anggotaKeluarga:nomor_ktp}', [AnggotaKeluargaController::class, 'show'])->name('show'); // admin.kartukeluarga.anggota.show

        // update
        Route::put('{anggotaKeluarga:nomor_ktp}', [AnggotaKeluargaController::class, 'update'])->name('update'); // admin.kartukeluarga.anggota.update
    });
    // end anggota keluarga

    // Tabel kartu keluarga
    Route::prefix('tabelkartukeluarga')->name('tabelkartukeluarga.')->group(function () {
        // index
        Route::get('', [TabelKartuKeluargaController::class, 'index'])->name('index'); // admin.tabelkartukeluarga.index

        // store gelar
        Route::post('gelar/store', [TabelKartuKeluargaController::class, 'storeGelar'])->name('storeGelar'); // admin.tabelkartukeluarga.storeGelar

        // update gelar
        Route::put('gelar/{gelar}/update', [TabelKartuKeluargaController::class, 'updateGelar'])->name('updateGelar'); // admin.tabelkartukeluarga.updateGelar

        // store golongan darah
        Route::post('golongandarah/store', [TabelKartuKeluargaController::class, 'storeGolonganDarah'])->name('storeGolonganDarah'); // admin.tabelkartukeluarga.storeGolonganDarah

        // update golongan darah
        Route::put('golongandarah/{golonganDarah}/update', [TabelKartuKeluargaController::class, 'updateGolonganDarah'])->name('updateGolonganDarah'); // admin.tabelkartukeluarga.updateGolonganDarah

        // store agama
        Route::post('agama/store', [TabelKartuKeluargaController::class, 'storeAgama'])->name('storeAgama'); // admin.tabelkartukeluarga.storeAgama

        // update agama
        Route::put('agama/{agama}/update', [TabelKartuKeluargaController::class, 'updateAgama'])->name('updateAgama'); // admin.tabelkartukeluarga.updateAgama

        // store status perkawinan
        Route::post('statusperkawinan/store', [TabelKartuKeluargaController::class, 'storeStatusPerkawinan'])->name('storeStatusPerkawinan'); // admin.tabelkartukeluarga.storeStatusPerkawinan

        // update status perkawinan
        Route::put('statusperkawinan/{statusPerkawinan}/update', [TabelKartuKeluargaController::class, 'updateStatusPerkawinan'])->name('updateStatusPerkawinan'); // admin.tabelkartukeluarga.updateStatusPerkawinan

        // store status hubungan dengan kepala keluarga
        Route::post('statushubungankepala/store', [TabelKartuKeluargaController::class, 'storeStatusHubunganKepala'])->name('storeStatusHubunganKepala'); // admin.tabelkartukeluarga.storeStatusHubunganKepala

        // update status hubungan dengan kepala keluarga
        Route::put('statushubungankepala/{statusHubunganKepala}/update', [TabelKartuKeluargaController::class, 'updateStatusHubunganKepala'])->name('updateStatusHubunganKepala'); // admin.tabelkartukeluarga.updateStatusHubunganKepala

        // store penyandang cacat
        Route::post('penyandangcacat/store', [TabelKartuKeluargaController::class, 'storePenyandangCacat'])->name('storePenyandangCacat'); // admin.tabelkartukeluarga.storePenyandangCacat

        // update penyandang cacat
        Route::put('penyandangcacat/{penyandangCacat}/update', [TabelKartuKeluargaController::class, 'updatePenyandangCacat'])->name('updatePenyandangCacat'); // admin.tabelkartukeluarga.updatePenyandangCacat

        // store pendidikan terakhir
        Route::post('pendidikan/store', [TabelKartuKeluargaController::class, 'storePendidikan'])->name('storePendidikan'); // admin.tabelkartukeluarga.storePendidikan

        // update pendidikan terakhir
        Route::put('pendidikan/{pendidikan}/update', [TabelKartuKeluargaController::class, 'updatePendidikan'])->name('updatePendidikan'); // admin.tabelkartukeluarga.updatePendidikan

        // store pekerjaan
        Route::post('pekerjaan/store', [TabelKartuKeluargaController::class, 'storePekerjaan'])->name('storePekerjaan'); // admin.tabelkartukeluarga.storePekerjaan

        // update pekerjaan
        Route::put('pekerjaan/{pekerjaan}/update', [TabelKartuKeluargaController::class, 'updatePekerjaan'])->name('updatePekerjaan'); // admin.tabelkartukeluarga.updatePekerjaan
    });
    // end Tabel kartu keluarga

    // Tabel Data Kelahiran
    Route::prefix('kelahiran')->name('kelahiran.')->group(function () {
        // index
        Route::get('', [DataKelahiranController::class, 'index'])->name('index'); // admin.kelahiran.index

        // create
        Route::get('create/{kartuKeluarga:nomorkk}', [DataKelahiranController::class, 'create'])->name('create'); // admin.kelahiran.create

        // create new
        Route::get('create/{kartuKeluarga:nomorkk}/new', [DataKelahiranController::class, 'createNew'])->name('create.new'); // admin.kelahiran.create.new

        // store exist
        Route::post('store/exist', [DataKelahiranController::class, 'storeExists'])->name('storeExists'); // admin.kelahiran.storeExists

        // store new
        Route::post('store/{kartuKeluarga:nomorkk}', [DataKelahiranController::class, 'store'])->name('store'); // admin.kelahiran.store

        // show
        Route::get('{dataKelahiran}', [DataKelahiranController::class, 'show'])->name('show'); // admin.kelahiran.show

        // print pdf
        Route::get('{dataKelahiran}/pdf', [DataKelahiranController::class, 'showPDF'])->name('show.pdf'); // admin.kelahiran.show.pdf
    });
    // end Tabel Data Kelahiran

    // Tabel kematian
    Route::prefix('kematian')->name('kematian.')->group(function () {
        // index
        Route::get('', [DataKematianController::class, 'index'])->name('index'); // admin.kematian.index

        // create
        Route::get('create/{kartuKeluarga:nomorkk}', [DataKematianController::class, 'create'])->name('create'); // admin.kematian.create

        // store
        Route::post('post', [DataKematianController::class, 'store'])->name('store'); // admin.kematian.store

        // show
        Route::get('{dataKematian}', [DataKematianController::class, 'show'])->name('show'); // admin.kematian.show

        // print pdf
        Route::get('{dataKematian}/pdf', [DataKematianController::class, 'showPDF'])->name('show.pdf'); // admin.kematian.show.pdf
    });
    // end Tabel kematian

    // table pindah masuk
    Route::prefix('pindahmasuk')->name('pindahmasuk.')->group(function () {
        // index
        Route::get('', [PindahMasukController::class, 'index'])->name('index'); // admin.pindahmasuk.index

        // create
        Route::get('create/{kartuKeluarga:nomorkk}', [PindahMasukController::class, 'create'])->name('create'); // admin.pindahmasuk.create

        // create new
        Route::get('create/{kartuKeluarga:nomorkk}/new', [PindahMasukController::class, 'createNew'])->name('create.new'); // admin.pindahmasuk.create.new

        // store
        Route::post('post/{kartuKeluarga:nomorkk}', [PindahMasukController::class, 'store'])->name('store'); // admin.pindahmasuk.store

        // store new
        Route::post('post/{kartuKeluarga:nomorkk}/new', [PindahMasukController::class, 'storeNew'])->name('store.new'); // admin.pindahmasuk.store.new

        // show
        Route::get('{pindahMasuk}', [PindahMasukController::class, 'show'])->name('show'); // admin.pindahmasuk.show

        // show view file
        Route::get('{pindahMasuk}/file', [PindahMasukController::class, 'showFile'])->name('show.file'); // admin.pindahmasuk.show.file

        // print pdf
        Route::get('{pindahMasuk}/pdf', [PindahMasukController::class, 'showPDF'])->name('show.pdf'); // admin.pindahmasuk.show.pdf
    });
    // end table pindah masuk

    // table pindah keluar
    Route::prefix('pindahkeluar')->name('pindahkeluar.')->group(function () {
        // index
        Route::get('', [PindahKeluarController::class, 'index'])->name('index'); // admin.pindahkeluar.index

        // create
        Route::get('create/{kartuKeluarga:nomorkk}', [PindahKeluarController::class, 'create'])->name('create'); // admin.pindahkeluar.create

        // store
        Route::post('store/{kartuKeluarga:nomorkk}', [PindahKeluarController::class, 'store'])->name('store'); // admin.pindahkeluar.store

        // show
        Route::get('{pindahKeluar}', [PindahKeluarController::class, 'show'])->name('show'); // admin.pindahkeluar.show

        // show view file
        Route::get('{pindahKeluar}/file', [PindahKeluarController::class, 'showFile'])->name('show.file'); // admin.pindahkeluar.show.file

        // print pdf
        Route::get('{pindahKeluar}/pdf', [PindahKeluarController::class, 'showPDF'])->name('show.pdf'); // admin.pindahkeluar.show.pdf
    });
    // end table pindah keluar

    // semua surat
    Route::prefix('surat')->name('surat.')->group(function () {
        // index
        Route::get('', [SuratController::class, 'index'])->name('index'); // admin.surat.index

        // create
        Route::get('create/{jenisSurat}', [SuratController::class, 'create'])->name('create'); // admin.surat.create

        // show anggota keluarga (chained dropdown)
        Route::get('create/anggotakeluargadropdown/{kartuKeluarga}', [SuratController::class, 'dropdown'])->name('dropdown'); // admin.surat.dropdown

        // store
        Route::post('post/{jenisSurat}', [SuratController::class, 'store'])->name('store'); // admin.surat.store

        // show
        Route::get('{administrasi}', [SuratController::class, 'show'])->name('show'); // admin.surat.show

        // show file
        Route::get('{administrasi}/file', [SuratController::class, 'showFile'])->name('show.file'); // admin.surat.show.file

        // show file result
        Route::get('{administrasi}/result/file', [SuratController::class, 'showResult'])->name('show.file.result'); // admin.surat.show.file.result
    });
    // end semua surat

    // jenis surat
    Route::prefix('jenis/surat')->name('jenis.')->group(function () {
        // index
        Route::get('', [JenisSuratController::class, 'index'])->name('index'); // admin.jenis.index

        // list
        Route::get('{jenisSurat}', [JenisSuratController::class, 'list'])->name('list'); // admin.jenis.list

        // show
        Route::get('{jenisSurat}/show', [JenisSuratController::class, 'show'])->name('show'); // admin.jenis.show

        // update
        Route::post('{jenisSurat}/show', [JenisSuratController::class, 'update'])->name('update'); // admin.jenis.update
    });
    // end jenis surat
});
// end admin

// auth
require __DIR__ . '/auth.php';
// end auth
