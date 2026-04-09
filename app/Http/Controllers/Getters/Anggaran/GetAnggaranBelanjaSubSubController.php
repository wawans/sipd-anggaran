<?php

namespace App\Http\Controllers\Getters\Anggaran;

use App\Http\Controllers\Concerns\WithExportImport;
use App\Http\Controllers\Controller;
use App\Jobs\Getters\Anggaran\GetAnggaranBelanjaSubSubJob;
use App\Models\Getters\Anggaran\GetAnggaranBelanjaSubSub;
use App\Repositories\Getters\Anggaran\GetAnggaranBelanjaSubSubRepository;
use Illuminate\Http\Request;

class GetAnggaranBelanjaSubSubController extends Controller
{
    use WithExportImport;

    public function __construct(protected GetAnggaranBelanjaSubSubRepository $repository) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = GetAnggaranBelanjaSubSub::query()
            ->orderBy('id')
            ->get();

        return response()->json(['status' => true, 'data' => $result]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(['data' => ['sometimes', 'nullable', 'array']]);

        defer(fn () => dispatch(new GetAnggaranBelanjaSubSubJob($validated['data'] ?? [])));

        return response()->json(['status' => true]);
    }

    public function truncate()
    {
        $this->repository->truncate();

        return response()->json(['status' => true]);
    }
}
