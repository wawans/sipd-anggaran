<?php

namespace App\Http\Controllers\Anggaran;

use App\Http\Controllers\Concerns\WithExportImport;
use App\Http\Controllers\Controller;
use App\Jobs\Anggaran\AnggaranBelanjaSubLabelJob;
use App\Models\Anggaran\AnggaranBelanjaSubLabel;
use App\Repositories\Anggaran\AnggaranBelanjaSubLabelRepository;
use App\Support\Response\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

// use App\Repositories\AnggaranBelanjaSubLabelRepository;

class AnggaranBelanjaSubLabelController extends Controller implements HasMiddleware
{
    use WithExportImport;

    public function __construct(protected AnggaranBelanjaSubLabelRepository $repository) {}

    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            // new Middleware('can:-INDEX'),
            // new Middleware('can:-CREATE', only: ['create', 'store']),
            // new Middleware('can:-UPDATE', only: ['edit', 'update']),
            // new Middleware('can:-DELETE', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $model = $this->repository->tableWithoutPagination()->table(request());

        return ApiResponse::make($model);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(['data' => ['required', 'array']]);
        dispatch(new AnggaranBelanjaSubLabelJob($validated['data']));

        return ApiResponse::data();
    }

    /**
     * Display the specified resource.
     */
    public function show(AnggaranBelanjaSubLabel $anggaranBelanjaSubLabel)
    {
        // $model = $this->repository->toArray($anggaranBelanjaSubLabel);
        // return ApiResponse::data($model);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AnggaranBelanjaSubLabel $anggaranBelanjaSubLabel)
    {
        // $model = $this->repository->edit($request->validated(), $anggaranBelanjaSubLabel);
        // return ApiResponse::data($model);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnggaranBelanjaSubLabel $anggaranBelanjaSubLabel)
    {
        // $this->repository->destroy($anggaranBelanjaSubLabel);
        // return ApiResponse::data();
    }

    /**
     * Remove resource(s) from storage.
     */
    public function destroys(Request $request)
    {
        // $validated = $request->validate(['ids' => 'array']);
        // $this->repository->destroys($validated['ids']);
        // return ApiResponse::data();
    }

    public function truncate()
    {
        $this->repository->truncate();

        return response()->json(['status' => true]);
    }
}
