<?php

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

Route::prefix('getter')->group(function () {
    Route::prefix('anggaran')->group(function () {
        Route::apiResource('skpd', AnggaranSkpdController::class)->only(['index', 'store']);
        Route::apiResource('belanja/sub/sub', AnggaranBelanjaSubSubController::class)->only(['index', 'store']);
        Route::apiResource('belanja/sub/rinci', AnggaranBelanjaSubRinciController::class)->only(['index', 'store']);
        Route::apiResource('belanja/sub/ket', AnggaranBelanjaSubKetController::class)->only(['index', 'store']);
        Route::apiResource('belanja/sub/dana', AnggaranBelanjaSubDanaController::class)->only(['index', 'store']);
        Route::apiResource('belanja/sub', AnggaranBelanjaSubController::class)->only(['index', 'store']);
    });
});
