<?php

namespace App\Http\Controllers\Getters\Anggaran;

use App\Http\Controllers\Concerns\WithExportImport;
use App\Http\Controllers\Controller;
use App\Jobs\Getters\Anggaran\AnggaranBelanjaSubOutputJob;
use App\Models\Getters\Anggaran\AnggaranBelanjaSubOutput;
use App\Repositories\Getters\Anggaran\AnggaranBelanjaSubOutputRepository;
use App\Support\Response\ApiResponse;
// use App\Repositories\AnggaranBelanjaSubOutputRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AnggaranBelanjaSubOutputController extends Controller implements HasMiddleware
{
    use WithExportImport;

    public function __construct(protected AnggaranBelanjaSubOutputRepository $repository) {}

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
        dispatch(new AnggaranBelanjaSubOutputJob($validated['data']));

        return ApiResponse::data();
    }

    /**
     * Display the specified resource.
     */
    public function show(AnggaranBelanjaSubOutput $anggaranBelanjaSubOutput)
    {
        // $model = $this->repository->toArray($anggaranBelanjaSubOutput);
        // return ApiResponse::data($model);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AnggaranBelanjaSubOutput $anggaranBelanjaSubOutput)
    {
        // $model = $this->repository->edit($request->validated(), $anggaranBelanjaSubOutput);
        // return ApiResponse::data($model);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnggaranBelanjaSubOutput $anggaranBelanjaSubOutput)
    {
        // $this->repository->destroy($anggaranBelanjaSubOutput);
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
