<?php

use App\Http\Controllers\Admin\KontenController;
use App\Http\Controllers\Admin\KulinerController;
use App\Http\Controllers\Admin\LaporanKunjunganController;
use App\Http\Controllers\Admin\LaporanTransaksiController;
use App\Http\Controllers\Admin\MerchantController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Admin\UmkmController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\Pimpinan\LaporanDataSewaController;
use App\Http\Controllers\Pimpinan\LaporanDataUmkmController;
use App\Http\Controllers\Pimpinan\LaporanDataWisataController;
use App\Http\Controllers\Web\TransaksiController as WebTransaksiController;
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
        Route::get('transaksi/{id}/selesai', [TransaksiController::class, 'selesai']);
        Route::get('laporan/transaksi', [LaporanTransaksiController::class, 'index']);
        Route::post('laporan/transaksi/cetak', [LaporanTransaksiController::class, 'cetak']);
        Route::get('laporan/kunjungan', [LaporanKunjunganController::class, 'index']);
        Route::post('laporan/kunjungan/cetak', [LaporanKunjunganController::class, 'cetak']);
        Route::get('qrcode', [KunjunganController::class, 'qrcode']);
        Route::get('laporan/data-wisata/print', [KontenController::class, 'print']);
        Route::get('laporan/data-umkm/print', [UmkmController::class, 'print']);
    });
    Route::prefix('pimpinan')->group(function () {
        Route::get('laporan/data-wisata', [LaporanDataWisataController::class, 'index']);
        Route::get('laporan/data-wisata/print', [LaporanDataWisataController::class, 'print']);
        Route::get('laporan/data-kunjungan', [LaporanKunjunganController::class, 'index']);
        Route::get('laporan/data-kunjungan/print', [LaporanKunjunganController::class, 'print']);
        Route::get('laporan/data-umkm', [LaporanDataUmkmController::class, 'index']);
        Route::get('laporan/data-umkm/print', [LaporanDataUmkmController::class, 'print']);
        Route::get('laporan/data-transaksi', [LaporanDataSewaController::class, 'index']);
        Route::get('laporan/data-transaksi/print', [LaporanDataSewaController::class, 'print']);
    });
});

Route::get('kunjungan/{id}', [KunjunganController::class, 'show']);
Route::get('invoice/{nomor_order}', [WebTransaksiController::class, 'index']);
