<?php

namespace App\Http\Controllers\Anggaran;

use App\Http\Controllers\Concerns\WithExportImport;
use App\Http\Controllers\Controller;
use App\Jobs\Anggaran\AnggaranSkpdJob;
use App\Models\Anggaran\AnggaranSkpd;
use App\Repositories\Anggaran\AnggaranSkpdRepository;
use Illuminate\Http\Request;

class AnggaranSkpdController extends Controller
{
    use WithExportImport;

    public function __construct(protected AnggaranSkpdRepository $repository) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $result = AnggaranSkpd::query()
            ->when($request->has('status'), function ($query) use ($request) {
                $query->where('status_getter', $request->input('status'));
            })
            ->when($request->has('tahun'), function ($query) use ($request) {
                $query->where('tahun', $request->input('tahun', now()->year));
            })
            ->orderBy('id')
            ->get();

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

    public function update(Request $request, AnggaranSkpd $id)
    {
        $validated = $request->validate(['status_getter' => ['required', 'boolean']]);

        $model = $this->repository->edit($validated, $id);

        return response()->json(['status' => true, 'data' => $model]);
    }

    public function updates(Request $request)
    {
        $validated = $request->validate([
            'status_getter' => ['required', 'boolean'],
            'ids' => ['required', 'array'],
        ]);

        $this->repository->edits(collect($validated)->except('ids')->toArray(), $validated['ids']);

        return response()->json(['status' => true]);
    }
}
