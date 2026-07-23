<?php

use App\Http\Controllers\Account\ApiTokenAccountController;
use App\Http\Controllers\Anggaran\AnggaranBelanjaSubController;
use App\Http\Controllers\Anggaran\AnggaranBelanjaSubDanaController;
use App\Http\Controllers\Anggaran\AnggaranBelanjaSubKetController;
use App\Http\Controllers\Anggaran\AnggaranBelanjaSubLabelController;
use App\Http\Controllers\Anggaran\AnggaranBelanjaSubOutputController;
use App\Http\Controllers\Anggaran\AnggaranBelanjaSubRinciController;
use App\Http\Controllers\Anggaran\AnggaranBelanjaSubSubController;
use App\Http\Controllers\Anggaran\AnggaranSkpdController;
use App\Http\Controllers\Master\AkunController;
use App\Http\Controllers\Master\DaerahController;
use App\Http\Controllers\Master\DanaController;
use App\Http\Controllers\Master\GiatController;
use App\Http\Controllers\Master\GiatSubController;
use App\Http\Controllers\Master\LabelKokabController;
use App\Http\Controllers\Master\LabelProvController;
use App\Http\Controllers\Master\LabelPusatController;
use App\Http\Controllers\Master\ProgramController;
use App\Http\Controllers\Master\SkpdController;
use App\Http\Controllers\Master\SkpdSubController;
use App\Http\Controllers\Master\UrusanBidangController;
use App\Http\Controllers\Master\UrusanController;
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

Route::middleware('auth:sanctum')->group(function () {
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
        Route::get('belanja/sub/label/export', [AnggaranBelanjaSubLabelController::class, 'export'])->name('belanja.sub.label.export');
        Route::get('belanja/sub/output/export', [AnggaranBelanjaSubOutputController::class, 'export'])->name('belanja.sub.output.export');

        Route::get('belanja/sub/sub/truncate', [AnggaranBelanjaSubSubController::class, 'truncate'])->name('belanja.sub.sub.truncate');
        Route::get('belanja/sub/rinci/truncate', [AnggaranBelanjaSubRinciController::class, 'truncate'])->name('belanja.sub.rinci.truncate');
        Route::get('belanja/sub/ket/truncate', [AnggaranBelanjaSubKetController::class, 'truncate'])->name('belanja.sub.ket.truncate');
        Route::get('belanja/sub/dana/truncate', [AnggaranBelanjaSubDanaController::class, 'truncate'])->name('belanja.sub.dana.truncate');
        Route::get('belanja/sub/label/truncate', [AnggaranBelanjaSubLabelController::class, 'truncate'])->name('belanja.sub.label.truncate');
        Route::get('belanja/sub/output/truncate', [AnggaranBelanjaSubOutputController::class, 'truncate'])->name('belanja.sub.output.truncate');

        Route::apiResource('skpd', AnggaranSkpdController::class)->parameter('skpd', 'id')->names('skpd');
        Route::apiResource('belanja/sub/sub', AnggaranBelanjaSubSubController::class)->parameter('sub', 'id')->names('belanja.sub.sub');
        Route::apiResource('belanja/sub/rinci', AnggaranBelanjaSubRinciController::class)->parameter('rinci', 'id')->names('belanja.sub.rinci');
        Route::apiResource('belanja/sub/ket', AnggaranBelanjaSubKetController::class)->parameter('ket', 'id')->names('belanja.sub.ket');
        Route::apiResource('belanja/sub/dana', AnggaranBelanjaSubDanaController::class)->parameter('dana', 'id')->names('belanja.sub.dana');
        Route::apiResource('belanja/sub/label', AnggaranBelanjaSubLabelController::class)->parameter('label', 'anggaranBelanjaSubLabel')->names('belanja.sub.label');
        Route::apiResource('belanja/sub/output', AnggaranBelanjaSubOutputController::class)->parameter('output', 'anggaranBelanjaSubOutput')->names('belanja.sub.output');
        Route::apiResource('belanja/sub', AnggaranBelanjaSubController::class)->parameter('sub', 'id')->names('belanja.sub');
    });

    Route::prefix('master')->name('master.')->group(function () {
        Route::get('akun/truncate', [AkunController::class, 'truncate'])->name('akun.truncate');
        Route::exportImport('akun', AkunController::class);
        Route::bulkResource('akun', AkunController::class);
        Route::apiResource('akun', AkunController::class)->parameter('akun', 'akun')->names('akun');

        Route::get('daerah/truncate', [DaerahController::class, 'truncate'])->name('daerah.truncate');
        Route::exportImport('daerah', DaerahController::class);
        Route::bulkResource('daerah', DaerahController::class);
        Route::apiResource('daerah', DaerahController::class)->parameter('daerah', 'daerah')->names('daerah');

        Route::get('dana/truncate', [DanaController::class, 'truncate'])->name('dana.truncate');
        Route::exportImport('dana', DanaController::class);
        Route::bulkResource('dana', DanaController::class);
        Route::apiResource('dana', DanaController::class)->parameter('dana', 'dana')->names('dana');

        Route::get('giat/truncate', [GiatController::class, 'truncate'])->name('giat.truncate');
        Route::exportImport('giat', GiatController::class);
        Route::bulkResource('giat', GiatController::class);
        Route::apiResource('giat', GiatController::class)->parameter('giat', 'giat')->names('giat');

        Route::get('giatSub/truncate', [GiatSubController::class, 'truncate'])->name('giatSub.truncate');
        Route::exportImport('giatSub', GiatSubController::class);
        Route::bulkResource('giatSub', GiatSubController::class);
        Route::apiResource('giatSub', GiatSubController::class)->parameter('giatSub', 'giatSub')->names('giatSub');

        Route::get('labelKokab/truncate', [LabelKokabController::class, 'truncate'])->name('labelKokab.truncate');
        Route::exportImport('labelKokab', LabelKokabController::class);
        Route::bulkResource('labelKokab', LabelKokabController::class);
        Route::apiResource('labelKokab', LabelKokabController::class)->parameter('labelKokab', 'labelKokab')->names('labelKokab');

        Route::get('labelProv/truncate', [LabelProvController::class, 'truncate'])->name('labelProv.truncate');
        Route::exportImport('labelProv', LabelProvController::class);
        Route::bulkResource('labelProv', LabelProvController::class);
        Route::apiResource('labelProv', LabelProvController::class)->parameter('labelProv', 'labelProv')->names('labelProv');

        Route::get('labelPusat/truncate', [LabelPusatController::class, 'truncate'])->name('labelPusat.truncate');
        Route::exportImport('labelPusat', LabelPusatController::class);
        Route::bulkResource('labelPusat', LabelPusatController::class);
        Route::apiResource('labelPusat', LabelPusatController::class)->parameter('labelPusat', 'labelPusat')->names('labelPusat');

        Route::get('program/truncate', [ProgramController::class, 'truncate'])->name('program.truncate');
        Route::exportImport('program', ProgramController::class);
        Route::bulkResource('program', ProgramController::class);
        Route::apiResource('program', ProgramController::class)->parameter('program', 'program')->names('program');

        Route::get('skpd/truncate', [SkpdController::class, 'truncate'])->name('skpd.truncate');
        Route::exportImport('skpd', SkpdController::class);
        Route::bulkResource('skpd', SkpdController::class);
        Route::apiResource('skpd', SkpdController::class)->parameter('skpd', 'skpd')->names('skpd');

        Route::get('skpdSub/truncate', [SkpdSubController::class, 'truncate'])->name('skpdSub.truncate');
        Route::exportImport('skpdSub', SkpdSubController::class);
        Route::bulkResource('skpdSub', SkpdSubController::class);
        Route::apiResource('skpdSub', SkpdSubController::class)->parameter('skpdSub', 'skpdSub')->names('skpdSub');

        Route::get('urusan/truncate', [UrusanController::class, 'truncate'])->name('urusan.truncate');
        Route::exportImport('urusan', UrusanController::class);
        Route::bulkResource('urusan', UrusanController::class);
        Route::apiResource('urusan', UrusanController::class)->parameter('urusan', 'urusan')->names('urusan');

        Route::get('urusanBidang/truncate', [UrusanBidangController::class, 'truncate'])->name('urusanBidang.truncate');
        Route::exportImport('urusanBidang', UrusanBidangController::class);
        Route::bulkResource('urusanBidang', UrusanBidangController::class);
        Route::apiResource('urusanBidang', UrusanBidangController::class)->parameter('urusanBidang', 'urusanBidang')->names('urusanBidang');

    });
});
