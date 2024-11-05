<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\HkiController;
use App\Http\Controllers\InsentifController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\PenelitianController;
use App\Http\Controllers\PkmController;
use App\Http\Controllers\PublikasiController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\UserContoller;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::middleware('auth:pegawai,dosen')->group(function() {
    Route::get('/', [MainController::class, 'index'])->name('base');
    Route::get('/input', [MainController::class, 'input'])->name('input');
    Route::get('/profil', [UserContoller::class, 'profil'])->name('profil');
    Route::put('/profil/update/{dosen}', [UserContoller::class, 'update_info'])->name('profil.update');
    Route::put('/profil/update-pict/{dosen}', [UserContoller::class, 'update_pict'])->name('profil.update.pict');
    Route::get('/test', [MainController::class, 'test']);

    Route::prefix('masterdata')->group(function() {
        Route::get('/', [MasterDataController::class, 'index'])->name('masterdata');
        Route::get('/dosen/add', [MasterDataController::class, 'create_dosen'])->name('dosen.create');
        Route::post('/dosen/store', [MasterDataController::class, 'store_dosen'])->name('dosen.store');
        Route::get('/mhs/add', [MasterDataController::class, 'create_mhs'])->name('mhs.create');
        Route::post('/mhs/create', [MasterDataController::class, 'store_mhs'])->name('mhs.store');
    });
    Route::prefix('data')->group(function() {
        Route::resource('penelitian', PenelitianController::class)->only(['index']);
        Route::resource('insentif', InsentifController::class)->only(['index']);
        Route::resource('pkm', PkmController::class)->only(['index']);
        Route::resource('hki', HkiController::class)->only(['index']);
        Route::resource('publikasi', PublikasiController::class)->only(['index']);
    });
    Route::get('/history', [MainController::class, 'history'])->name('history');

    Route::resource('penelitian', PenelitianController::class)->except(['index']);
    Route::resource('insentif', InsentifController::class)->except(['index']);
    Route::resource('pkm', PkmController::class)->except(['index']);
    Route::resource('hki', HkiController::class)->except(['index']);
    Route::resource('publikasi', PublikasiController::class)->except(['index']);
    Route::get('/accept/penelitian/{id}', [PenelitianController::class, 'accept'])->name('acc.penelitian');
    Route::get('/accept/pkm/{id}', [PkmController::class, 'accept'])->name('acc.pkm');
    Route::get('/accept/insentif/{id}', [InsentifController::class, 'accept'])->name('acc.insentif');
    Route::get('/accept/hki/{id}', [HkiController::class, 'accept'])->name('acc.hki');
    Route::get('/accept/publikasi/{id}', [PublikasiController::class, 'accept'])->name('acc.publikasi');
    Route::get('/delete/penelitian/{id}', [PenelitianController::class, 'delete'])->name('del.penelitian');
    Route::get('/delete/pkm/{id}', [PkmController::class, 'delete'])->name('del.pkm');
    Route::get('/delete/insentif/{id}', [InsentifController::class, 'delete'])->name('del.insentif');
    Route::get('/delete/hki/{id}', [HkiController::class, 'delete'])->name('del.hki');
    Route::get('/delete/publikasi/{id}', [PublikasiController::class, 'delete'])->name('del.publikasi');
    // Route::get('/form-pkm', [MainController::class, 'input_pkm'])->name('pkm');
    // Route::get('/form-isentif', [MainController::class, 'input_insentif'])->name('insentif');
    // Route::get('/form-hki', [MainController::class, 'input_haki'])->name('haki');

    // json
    Route::get('/data-dosen', [MainController::class, 'get_dosen'])->name('get_dosen');
    Route::get('/data-mhs', [MainController::class, 'get_mhs'])->name('get_mhs');
    Route::get('/data-hibah', [MainController::class, 'get_hibah'])->name('get_hibah');
    Route::get('/data-insentif', [MainController::class, 'get_insentif'])->name('get_insentif');
    Route::get('/data-publikasi', [MainController::class, 'get_pub'])->name('get_pub');
    Route::get('/data-publikasi2', [MainController::class, 'get_pub2'])->name('get_pub2');
    Route::get('/nama-kegiatan', [MainController::class, 'get_keg'])->name('get_keg');
    Route::get('/total-jumlah/{tahun?}', [MainController::class, 'getTotalJumlah'])->name('get_jumlah');
    Route::get('/total-biaya/{tahun?}', [MainController::class, 'getTotalBiaya'])->name('get_total');
});

Route::middleware('auth:pegawai')->group(function() {
    Route::get('/kotak-masuk', [MainController::class, 'inbox'])->name('inbox');

    //Surat-Menyurat
    Route::prefix('surat')->name('surat.')->group(function() {
        Route::get('/', [SuratController::class, 'index'])->name('index');
        Route::get('/buat', [SuratController::class, 'input_surat'])->name('input');
        Route::post('/store', [SuratController::class, 'store_surat'])->name('store');
        Route::get('/view/{id}', [SuratController::class, 'tampil_surat'])->name('tampil');
        
        Route::prefix('masuk')->name('masuk.')->group(function() {
            Route::get('/', [SuratController::class, 'input_surat_masuk'])->name('input');
            Route::post('/store', [SuratController::class, 'store_surat_masuk'])->name('store');
        });
    });
   
});

Route::get('surat/cek/{id}', [SuratController::class, 'cek_surat'])->name('surat.cek');