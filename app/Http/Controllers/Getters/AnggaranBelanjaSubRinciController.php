<?php

namespace App\Http\Controllers\Getters;

use App\Http\Controllers\Concerns\WithExportImport;
use App\Http\Controllers\Controller;
use App\Jobs\Getters\AnggaranBelanjaSubRinciJob;
use App\Models\Getters\GetAnggaranBelanjaSubRinci;
use App\Repositories\Getters\GetAnggaranBelanjaSubRinciRepository;
use Illuminate\Http\Request;

class AnggaranBelanjaSubRinciController extends Controller
{
    use WithExportImport;

    public function __construct(protected GetAnggaranBelanjaSubRinciRepository $repository) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = GetAnggaranBelanjaSubRinci::query()->where('status_getter', true)
            ->orderBy('id')->get();

        return response()->json(['status' => true, 'data' => $result]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(['data' => ['sometimes', 'nullable', 'array']]);

        defer(fn () => dispatch(new AnggaranBelanjaSubRinciJob($validated['data'] ?? [])));

        return response()->json(['status' => true]);
    }

    public function truncate()
    {
        $this->repository->truncate();

        return response()->json(['status' => true]);
    }
}
