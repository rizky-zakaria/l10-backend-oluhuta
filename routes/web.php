<?php

use App\Http\Controllers\Admin\KontenController;
use App\Http\Controllers\Admin\KulinerController;
use App\Http\Controllers\Admin\LaporanKunjunganController;
use App\Http\Controllers\Admin\LaporanTransaksiController;
use App\Http\Controllers\Admin\MerchantController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Admin\UmkmController;
use App\Http\Controllers\KunjunganController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::prefix('admin')->group(function () {
        Route::resource('konten', KontenController::class);
        Route::resource('merchant', MerchantController::class);
        Route::resource('kuliner', KulinerController::class);
        Route::resource('umkm-lokal', UmkmController::class);
        Route::get('transaksi', [TransaksiController::class, 'index']);
        Route::get('laporan/transaksi', [LaporanTransaksiController::class, 'index']);
        Route::post('laporan/transaksi/cetak', [LaporanTransaksiController::class, 'cetak']);
        Route::get('laporan/kunjungan', [LaporanKunjunganController::class, 'index']);
        Route::post('laporan/kunjungan/cetak', [LaporanKunjunganController::class, 'cetak']);
        Route::get('qrcode', [KunjunganController::class, 'qrcode']);
    });
});

Route::get('kunjungan/{id}', [KunjunganController::class, 'show']);
