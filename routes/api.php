<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {

    Route::post('/login', App\Http\Controllers\Api\Admin\LoginController::class, ['as' => 'admin']);

    Route::group(['middleware' => 'auth:api'], function () {

        Route::get('/user', function (Request $request) {
            return $request->user();
        })->name('user');
        Route::get('/kategori', App\Http\Controllers\Api\Admin\KategoriController::class, ['as' => 'admin']);
        Route::post('/logout', App\Http\Controllers\Api\Admin\LogoutController::class, ['as' => 'admin']);
        Route::apiResource('/konten', App\Http\Controllers\Api\Admin\KontenController::class, ['except' => ['create', 'edit'], 'as' => 'admin']);
    });
});

Route::prefix('client')->group(function () {
    Route::post('/login', App\Http\Controllers\Api\Admin\LoginController::class, ['as' => 'user']);

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('/user', function (Request $request) {
            return $request->user();
        })->name('user');
        Route::apiResource('/geodiveristy', App\Http\Controllers\Api\Client\GeodiveristyController::class, ['except' => ['create', 'edit', 'update', 'destroy'], 'as' => 'user']);
        Route::apiResource('/biodiversity', App\Http\Controllers\Api\Client\BiodiversityController::class, ['except' => ['create', 'edit', 'update', 'destroy'], 'as' => 'user']);
        Route::apiResource('/culturdiversity', App\Http\Controllers\Api\Client\CulturdiversityController::class, ['except' => ['create', 'edit', 'update', 'destroy'], 'as' => 'user']);
        Route::apiResource('/berita', App\Http\Controllers\Api\Client\BeritaController::class, ['except' => ['create', 'edit', 'update', 'destroy'], 'as' => 'user']);
        Route::apiResource('/merchant', App\Http\Controllers\Api\Client\MerchatController::class, ['except' => ['create', 'edit', 'update', 'destroy'], 'as' => 'user']);
        Route::get('product/{id}', [App\Http\Controllers\Api\Client\MerchatController::class, 'product']);
        Route::post('transaksis/payment', [App\Http\Controllers\Api\Client\TransaksiController::class, 'create']);
        Route::get('transaksis/payment/{status}', [App\Http\Controllers\Api\Client\TransaksiController::class, 'index']);
        Route::post('/logout', App\Http\Controllers\Api\Admin\LogoutController::class, ['as' => 'user']);
    });
    Route::post('transaksis/webhook', [App\Http\Controllers\Api\Client\TransaksiController::class, 'webhook']);
});

Route::prefix('web')->group(function () {
    Route::get('/berita', [App\Http\Controllers\Api\Web\BeritaController::class, 'index', ['as' => 'web']]);
});
