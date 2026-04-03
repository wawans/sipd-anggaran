<?php

namespace App\Http\Controllers\Getters;

use App\Http\Controllers\Concerns\WithExportImport;
use App\Http\Controllers\Controller;
use App\Jobs\Getters\AnggaranBelanjaSubDanaJob;
use App\Models\Getters\GetAnggaranBelanjaSubDana;
use App\Repositories\Getters\GetAnggaranBelanjaSubDanaRepository;
use Illuminate\Http\Request;

class AnggaranBelanjaSubDanaController extends Controller
{
    use WithExportImport;

    public function __construct(protected GetAnggaranBelanjaSubDanaRepository $repository) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = GetAnggaranBelanjaSubDana::query()
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

        defer(fn () => dispatch(new AnggaranBelanjaSubDanaJob($validated['data'] ?? [])));

        return response()->json(['status' => true]);
    }

    public function truncate()
    {
        $this->repository->truncate();

        return response()->json(['status' => true]);
    }
}
