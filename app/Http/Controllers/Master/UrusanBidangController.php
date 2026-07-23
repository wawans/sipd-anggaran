<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Concerns\WithExportImport;
use App\Http\Controllers\Controller;
use App\Jobs\Master\UrusanBidangJob;
use App\Models\Master\UrusanBidang;
use App\Repositories\Master\UrusanBidangRepository;
use App\Support\Response\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

// use App\Repositories\UrusanBidangRepository;

class UrusanBidangController extends Controller implements HasMiddleware
{
    use WithExportImport;

    public function __construct(protected UrusanBidangRepository $repository) {}

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
        dispatch(new UrusanBidangJob($validated['data']));

        return ApiResponse::data();
    }

    /**
     * Display the specified resource.
     */
    public function show(UrusanBidang $urusanBidang)
    {
        // $model = $this->repository->toArray($urusanBidang);
        // return ApiResponse::data($model);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UrusanBidang $urusanBidang)
    {
        // $model = $this->repository->edit($request->validated(), $urusanBidang);
        // return ApiResponse::data($model);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UrusanBidang $urusanBidang)
    {
        // $this->repository->destroy($urusanBidang);
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
}
