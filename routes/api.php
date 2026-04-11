<?php

use App\Http\Controllers\Account\ApiTokenAccountController;
use App\Http\Controllers\Getters\Anggaran\GetAnggaranBelanjaSubController;
use App\Http\Controllers\Getters\Anggaran\GetAnggaranBelanjaSubDanaController;
use App\Http\Controllers\Getters\Anggaran\GetAnggaranBelanjaSubKetController;
use App\Http\Controllers\Getters\Anggaran\GetAnggaranBelanjaSubLabelController;
use App\Http\Controllers\Getters\Anggaran\GetAnggaranBelanjaSubOutputController;
use App\Http\Controllers\Getters\Anggaran\GetAnggaranBelanjaSubRinciController;
use App\Http\Controllers\Getters\Anggaran\GetAnggaranBelanjaSubSubController;
use App\Http\Controllers\Getters\Anggaran\GetAnggaranSkpdController;
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
        Route::prefix('skpd')->name('skpd.')->controller(GetAnggaranSkpdController::class)->group(function () {
            Route::put('/', 'updates')->name('updates');
            Route::delete('/', 'destroys')->name('destroys');

            Route::get('/export', 'export')->name('export');
            Route::get('/truncate', 'truncate')->name('truncate');
        });

        Route::prefix('belanja/sub')->name('belanja.sub.')->controller(GetAnggaranBelanjaSubController::class)->group(function () {
            Route::put('/', 'updates')->name('updates');
            Route::delete('/', 'destroys')->name('destroys');

            Route::get('/export', 'export')->name('export');
            Route::get('/truncate', 'truncate')->name('truncate');
        });

        Route::get('belanja/sub/sub/export', [GetAnggaranBelanjaSubSubController::class, 'export'])->name('belanja.sub.sub.export');
        Route::get('belanja/sub/rinci/export', [GetAnggaranBelanjaSubRinciController::class, 'export'])->name('belanja.sub.rinci.export');
        Route::get('belanja/sub/ket/export', [GetAnggaranBelanjaSubKetController::class, 'export'])->name('belanja.sub.ket.export');
        Route::get('belanja/sub/dana/export', [GetAnggaranBelanjaSubDanaController::class, 'export'])->name('belanja.sub.dana.export');
        Route::get('belanja/sub/label/export', [GetAnggaranBelanjaSubLabelController::class, 'export'])->name('belanja.sub.label.export');
        Route::get('belanja/sub/output/export', [GetAnggaranBelanjaSubOutputController::class, 'export'])->name('belanja.sub.output.export');

        Route::get('belanja/sub/sub/truncate', [GetAnggaranBelanjaSubSubController::class, 'truncate'])->name('belanja.sub.sub.truncate');
        Route::get('belanja/sub/rinci/truncate', [GetAnggaranBelanjaSubRinciController::class, 'truncate'])->name('belanja.sub.rinci.truncate');
        Route::get('belanja/sub/ket/truncate', [GetAnggaranBelanjaSubKetController::class, 'truncate'])->name('belanja.sub.ket.truncate');
        Route::get('belanja/sub/dana/truncate', [GetAnggaranBelanjaSubDanaController::class, 'truncate'])->name('belanja.sub.dana.truncate');
        Route::get('belanja/sub/label/truncate', [GetAnggaranBelanjaSubLabelController::class, 'truncate'])->name('belanja.sub.label.truncate');
        Route::get('belanja/sub/output/truncate', [GetAnggaranBelanjaSubOutputController::class, 'truncate'])->name('belanja.sub.output.truncate');

        Route::apiResource('skpd', GetAnggaranSkpdController::class)->parameter('skpd', 'id')->names('skpd');
        Route::apiResource('belanja/sub/sub', GetAnggaranBelanjaSubSubController::class)->parameter('sub', 'id')->names('belanja.sub.sub');
        Route::apiResource('belanja/sub/rinci', GetAnggaranBelanjaSubRinciController::class)->parameter('rinci', 'id')->names('belanja.sub.rinci');
        Route::apiResource('belanja/sub/ket', GetAnggaranBelanjaSubKetController::class)->parameter('ket', 'id')->names('belanja.sub.ket');
        Route::apiResource('belanja/sub/dana', GetAnggaranBelanjaSubDanaController::class)->parameter('dana', 'id')->names('belanja.sub.dana');
        Route::apiResource('belanja/sub/label', GetAnggaranBelanjaSubLabelController::class)->parameter('label', 'getAnggaranBelanjaSubLabel')->names('belanja.sub.label');
        Route::apiResource('belanja/sub/output', GetAnggaranBelanjaSubOutputController::class)->parameter('output', 'getAnggaranBelanjaSubOutput')->names('belanja.sub.output');
        Route::apiResource('belanja/sub', GetAnggaranBelanjaSubController::class)->parameter('sub', 'id')->names('belanja.sub');
    });

    Route::prefix('master')->name('master.')->group(function () {
        Route::get('akun/truncate', [GetAkunController::class, 'truncate'])->name('akun.truncate');
        Route::exportImport('akun', GetAkunController::class);
        Route::bulkResource('akun', GetAkunController::class);
        Route::apiResource('akun', GetAkunController::class)->parameter('akun', 'getAkun')->names('akun');

        Route::get('daerah/truncate', [GetDaerahController::class, 'truncate'])->name('daerah.truncate');
        Route::exportImport('daerah', GetDaerahController::class);
        Route::bulkResource('daerah', GetDaerahController::class);
        Route::apiResource('daerah', GetDaerahController::class)->parameter('daerah', 'getDaerah')->names('daerah');

        Route::get('dana/truncate', [GetDanaController::class, 'truncate'])->name('dana.truncate');
        Route::exportImport('dana', GetDanaController::class);
        Route::bulkResource('dana', GetDanaController::class);
        Route::apiResource('dana', GetDanaController::class)->parameter('dana', 'getDana')->names('dana');

        Route::get('giat/truncate', [GetGiatController::class, 'truncate'])->name('giat.truncate');
        Route::exportImport('giat', GetGiatController::class);
        Route::bulkResource('giat', GetGiatController::class);
        Route::apiResource('giat', GetGiatController::class)->parameter('giat', 'getGiat')->names('giat');

        Route::get('giatSub/truncate', [GetGiatSubController::class, 'truncate'])->name('giatSub.truncate');
        Route::exportImport('giatSub', GetGiatSubController::class);
        Route::bulkResource('giatSub', GetGiatSubController::class);
        Route::apiResource('giatSub', GetGiatSubController::class)->parameter('giatSub', 'getGiatSub')->names('giatSub');

        Route::get('labelKokab/truncate', [GetLabelKokabController::class, 'truncate'])->name('labelKokab.truncate');
        Route::exportImport('labelKokab', GetLabelKokabController::class);
        Route::bulkResource('labelKokab', GetLabelKokabController::class);
        Route::apiResource('labelKokab', GetLabelKokabController::class)->parameter('labelKokab', 'getLabelKokab')->names('labelKokab');

        Route::get('labelProv/truncate', [GetLabelProvController::class, 'truncate'])->name('labelProv.truncate');
        Route::exportImport('labelProv', GetLabelProvController::class);
        Route::bulkResource('labelProv', GetLabelProvController::class);
        Route::apiResource('labelProv', GetLabelProvController::class)->parameter('labelProv', 'getLabelProv')->names('labelProv');

        Route::get('labelPusat/truncate', [GetLabelPusatController::class, 'truncate'])->name('labelPusat.truncate');
        Route::exportImport('labelPusat', GetLabelPusatController::class);
        Route::bulkResource('labelPusat', GetLabelPusatController::class);
        Route::apiResource('labelPusat', GetLabelPusatController::class)->parameter('labelPusat', 'getLabelPusat')->names('labelPusat');

        Route::get('program/truncate', [GetProgramController::class, 'truncate'])->name('program.truncate');
        Route::exportImport('program', GetProgramController::class);
        Route::bulkResource('program', GetProgramController::class);
        Route::apiResource('program', GetProgramController::class)->parameter('program', 'getProgram')->names('program');

        Route::get('skpd/truncate', [GetSkpdController::class, 'truncate'])->name('skpd.truncate');
        Route::exportImport('skpd', GetSkpdController::class);
        Route::bulkResource('skpd', GetSkpdController::class);
        Route::apiResource('skpd', GetSkpdController::class)->parameter('skpd', 'getSkpd')->names('skpd');

        Route::get('skpdSub/truncate', [GetSkpdSubController::class, 'truncate'])->name('skpdSub.truncate');
        Route::exportImport('skpdSub', GetSkpdSubController::class);
        Route::bulkResource('skpdSub', GetSkpdSubController::class);
        Route::apiResource('skpdSub', GetSkpdSubController::class)->parameter('skpdSub', 'getSkpdSub')->names('skpdSub');

        Route::get('urusan/truncate', [GetUrusanController::class, 'truncate'])->name('urusan.truncate');
        Route::exportImport('urusan', GetUrusanController::class);
        Route::bulkResource('urusan', GetUrusanController::class);
        Route::apiResource('urusan', GetUrusanController::class)->parameter('urusan', 'getUrusan')->names('urusan');

        Route::get('urusanBidang/truncate', [GetUrusanBidangController::class, 'truncate'])->name('urusanBidang.truncate');
        Route::exportImport('urusanBidang', GetUrusanBidangController::class);
        Route::bulkResource('urusanBidang', GetUrusanBidangController::class);
        Route::apiResource('urusanBidang', GetUrusanBidangController::class)->parameter('urusanBidang', 'getUrusanBidang')->names('urusanBidang');

    });
});
