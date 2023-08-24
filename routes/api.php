<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {

    Route::post('/login', App\Http\Controllers\Api\Admin\LoginController::class, ['as' => 'admin']);

    Route::group(['middleware' => 'auth:api'], function () {

        Route::get('/user', function (Request $request) {
            return $request->user();
        })->name('user');

        Route::post('/logout', App\Http\Controllers\Api\Admin\LogoutController::class, ['as' => 'admin']);
    });
});

Route::prefix('web')->group(function () {
    Route::get('/berita', [App\Http\Controllers\Api\Web\BeritaController::class, 'index', ['as' => 'web']]);
});
