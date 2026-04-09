<?php

namespace App\Http\Controllers\Getters\Anggaran;

use App\Http\Controllers\Concerns\WithExportImport;
use App\Http\Controllers\Controller;
use App\Jobs\Getters\Anggaran\GetAnggaranBelanjaSubRinciJob;
use App\Models\Getters\Anggaran\GetAnggaranBelanjaSubRinci;
use App\Repositories\Getters\Anggaran\GetAnggaranBelanjaSubRinciRepository;
use Illuminate\Http\Request;

class GetAnggaranBelanjaSubRinciController extends Controller
{
    use WithExportImport;

    public function __construct(protected GetAnggaranBelanjaSubRinciRepository $repository) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = GetAnggaranBelanjaSubRinci::query()
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

        defer(fn () => dispatch(new GetAnggaranBelanjaSubRinciJob($validated['data'] ?? [])));

        return response()->json(['status' => true]);
    }

    public function truncate()
    {
        $this->repository->truncate();

        return response()->json(['status' => true]);
    }
}
