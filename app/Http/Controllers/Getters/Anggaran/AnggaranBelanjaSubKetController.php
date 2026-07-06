<?php

namespace App\Http\Controllers\Getters\Anggaran;

use App\Http\Controllers\Concerns\WithExportImport;
use App\Http\Controllers\Controller;
use App\Jobs\Getters\Anggaran\AnggaranBelanjaSubKetJob;
use App\Models\Getters\Anggaran\AnggaranBelanjaSubKet;
use App\Repositories\Getters\Anggaran\AnggaranBelanjaSubKetRepository;
use Illuminate\Http\Request;

class AnggaranBelanjaSubKetController extends Controller
{
    use WithExportImport;

    public function __construct(protected AnggaranBelanjaSubKetRepository $repository) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = AnggaranBelanjaSubKet::query()
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
