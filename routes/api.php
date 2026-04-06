<?php

use App\Http\Controllers\Account\ApiTokenAccountController;
use App\Http\Controllers\Getters\AnggaranBelanjaSubController;
use App\Http\Controllers\Getters\AnggaranBelanjaSubDanaController;
use App\Http\Controllers\Getters\AnggaranBelanjaSubKetController;
use App\Http\Controllers\Getters\AnggaranBelanjaSubRinciController;
use App\Http\Controllers\Getters\AnggaranBelanjaSubSubController;
use App\Http\Controllers\Getters\AnggaranSkpdController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/auth/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->prefix('account')->name('account.')->group(function () {
    Route::apiResource('token', ApiTokenAccountController::class);
});

Route::middleware('auth:sanctum')->prefix('getter')->name('getter.')->group(function () {
    Route::prefix('anggaran')->name('anggaran.')->group(function () {
        Route::prefix('skpd')->name('skpd.')->controller(AnggaranSkpdController::class)->group(function () {
            Route::put('/', 'updates')->name('updates');
            Route::delete('/', 'destroys')->name('destroys');

            Route::get('/export', 'export')->name('export');
            Route::get('/truncate', 'truncate')->name('truncate');
        });

        Route::prefix('belanja/sub')->name('belanja.sub.')->controller(AnggaranBelanjaSubController::class)->group(function () {
            Route::put('/', 'updates')->name('updates');
            Route::delete('/', 'destroys')->name('destroys');

            Route::get('/export', 'export')->name('export');
            Route::get('/truncate', 'truncate')->name('truncate');
        });

        Route::get('belanja/sub/sub/export', [AnggaranBelanjaSubSubController::class, 'export'])->name('belanja.sub.sub.export');
        Route::get('belanja/sub/rinci/export', [AnggaranBelanjaSubRinciController::class, 'export'])->name('belanja.sub.rinci.export');
        Route::get('belanja/sub/ket/export', [AnggaranBelanjaSubKetController::class, 'export'])->name('belanja.sub.ket.export');
        Route::get('belanja/sub/dana/export', [AnggaranBelanjaSubDanaController::class, 'export'])->name('belanja.sub.dana.export');

        Route::get('belanja/sub/sub/truncate', [AnggaranBelanjaSubSubController::class, 'truncate'])->name('belanja.sub.sub.truncate');
        Route::get('belanja/sub/rinci/truncate', [AnggaranBelanjaSubRinciController::class, 'truncate'])->name('belanja.sub.rinci.truncate');
        Route::get('belanja/sub/ket/truncate', [AnggaranBelanjaSubKetController::class, 'truncate'])->name('belanja.sub.ket.truncate');
        Route::get('belanja/sub/dana/truncate', [AnggaranBelanjaSubDanaController::class, 'truncate'])->name('belanja.sub.dana.truncate');

        Route::apiResource('skpd', AnggaranSkpdController::class)->parameter('skpd', 'id')->names('skpd');
        Route::apiResource('belanja/sub/sub', AnggaranBelanjaSubSubController::class)->parameter('sub', 'id')->names('belanja.sub.sub');
        Route::apiResource('belanja/sub/rinci', AnggaranBelanjaSubRinciController::class)->parameter('rinci', 'id')->names('belanja.sub.rinci');
        Route::apiResource('belanja/sub/ket', AnggaranBelanjaSubKetController::class)->parameter('ket', 'id')->names('belanja.sub.ket');
        Route::apiResource('belanja/sub/dana', AnggaranBelanjaSubDanaController::class)->parameter('dana', 'id')->names('belanja.sub.dana');
        Route::apiResource('belanja/sub', AnggaranBelanjaSubController::class)->parameter('sub', 'id')->names('belanja.sub');
    });
});
