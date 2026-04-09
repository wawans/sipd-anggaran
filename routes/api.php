<?php

use App\Http\Controllers\Account\ApiTokenAccountController;
use App\Http\Controllers\Getters\AnggaranBelanjaSubController;
use App\Http\Controllers\Getters\AnggaranBelanjaSubDanaController;
use App\Http\Controllers\Getters\AnggaranBelanjaSubKetController;
use App\Http\Controllers\Getters\AnggaranBelanjaSubRinciController;
use App\Http\Controllers\Getters\AnggaranBelanjaSubSubController;
use App\Http\Controllers\Getters\AnggaranSkpdController;
use App\Http\Controllers\Getters\Master\GetAkunController;
use App\Http\Controllers\Getters\Master\GetDaerahController;
use App\Http\Controllers\Getters\Master\GetDanaController;
use App\Http\Controllers\Getters\Master\GetGiatController;
use App\Http\Controllers\Getters\Master\GetGiatSubController;
use App\Http\Controllers\Getters\Master\GetLabelKokabController;
use App\Http\Controllers\Getters\Master\GetLabelProvController;
use App\Http\Controllers\Getters\Master\GetLabelPusatController;
use App\Http\Controllers\Getters\Master\GetProgramController;
use App\Http\Controllers\Getters\Master\GetSkpdController;
use App\Http\Controllers\Getters\Master\GetSkpdSubController;
use App\Http\Controllers\Getters\Master\GetUrusanBidangController;
use App\Http\Controllers\Getters\Master\GetUrusanController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/auth/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('account')->name('account.')->group(function () {
        Route::apiResource('token', ApiTokenAccountController::class);
    });
    Route::prefix('user')->name('user.')->controller(UserController::class)->group(function () {
        Route::post('/deletes', 'destroys')->name('destroys');
        Route::post('/import', 'import')->name('import');
        Route::get('/export/template', 'template')->name('export.template');
        Route::get('/export', 'export')->name('export');
    });
    Route::apiResource('user', UserController::class)->names('user');
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

    Route::prefix('master')->name('master.')->group(function () {
        Route::apiResource('akun', GetAkunController::class)->parameter('akun', 'getAkun')->names('akun');
        Route::apiResource('daerah', GetDaerahController::class)->parameter('daerah', 'getDaerah')->names('daerah');
        Route::apiResource('dana', GetDanaController::class)->parameter('dana', 'getDana')->names('dana');
        Route::apiResource('giat', GetGiatController::class)->parameter('giat', 'getGiat')->names('giat');
        Route::apiResource('giatSub', GetGiatSubController::class)->parameter('giatSub', 'getGiatSub')->names('giatSub');
        Route::apiResource('labelKokab', GetLabelKokabController::class)->parameter('labelKokab', 'getLabelKokab')->names('labelKokab');
        Route::apiResource('labelProv', GetLabelProvController::class)->parameter('labelProv', 'getLabelProv')->names('labelProv');
        Route::apiResource('labelPusat', GetLabelPusatController::class)->parameter('labelPusat', 'getLabelPusat')->names('labelPusat');
        Route::apiResource('program', GetProgramController::class)->parameter('program', 'getProgram')->names('program');
        Route::apiResource('skpd', GetSkpdController::class)->parameter('skpd', 'getSkpd')->names('skpd');
        Route::apiResource('skpdSub', GetSkpdSubController::class)->parameter('skpdSub', 'getSkpdSub')->names('skpdSub');
        Route::apiResource('urusan', GetUrusanController::class)->parameter('urusan', 'getUrusan')->names('urusan');
        Route::apiResource('urusanBidang', GetUrusanBidangController::class)->parameter('urusanBidang', 'getUrusanBidang')->names('urusanBidang');
    });
});
