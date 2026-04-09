<?php

namespace App\Http\Controllers\Getters;

use App\Http\Controllers\Concerns\WithExportImport;
use App\Http\Controllers\Controller;
use App\Jobs\Getters\Anggaran\BelanjaSub\Ket\AnggaranBelanjaSubKetJob;
use App\Models\Getters\GetAnggaranBelanjaSubKet;
use App\Repositories\Getters\GetAnggaranBelanjaSubKetRepository;
use Illuminate\Http\Request;

class AnggaranBelanjaSubKetController extends Controller
{
    use WithExportImport;

    public function __construct(protected GetAnggaranBelanjaSubKetRepository $repository) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = GetAnggaranBelanjaSubKet::query()
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

        defer(fn () => dispatch(new AnggaranBelanjaSubKetJob($validated['data'] ?? [])));

        return response()->json(['status' => true]);
    }

    public function truncate()
    {
        $this->repository->truncate();

        return response()->json(['status' => true]);
    }
}
