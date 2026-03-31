<?php

namespace App\Http\Controllers\Getters;

use App\Http\Controllers\Concerns\WithExportImport;
use App\Http\Controllers\Controller;
use App\Jobs\Getters\AnggaranSkpdJob;
use App\Models\Getters\GetAnggaranSkpd;
use App\Repositories\Getters\GetAnggaranSkpdRepository;
use Illuminate\Http\Request;

class AnggaranSkpdController extends Controller
{
    use WithExportImport;

    public function __construct(protected GetAnggaranSkpdRepository $repository) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = GetAnggaranSkpd::query()->where('status_getter', true)
            ->orderBy('id')->get();

        return response()->json(['status' => true, 'data' => $result]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(['data' => ['required', 'array']]);

        dispatch(new AnggaranSkpdJob($validated['data']));

        return response()->json(['status' => true]);
    }
}
