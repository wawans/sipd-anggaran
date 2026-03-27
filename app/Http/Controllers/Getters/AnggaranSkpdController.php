<?php

namespace App\Http\Controllers\Getters;

use App\Http\Controllers\Controller;
use App\Models\Getters\GetAnggaranSkpd;
use Illuminate\Http\Request;

class AnggaranSkpdController extends Controller
{
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

        defer(fn () => $this->handle($validated['data']));

        return response()->json(['status' => true]);
    }

    private function handle(array $data)
    {
        foreach ($data as $row) {
            GetAnggaranSkpd::updateOrCreate([
                'tahun' => data_get($row, 'tahun'),
                'id_daerah' => data_get($row, 'id_daerah'),
                'id_skpd' => data_get($row, 'id_skpd'),
                'id_unit' => data_get($row, 'id_unit'),
            ], [
                'kode_skpd' => data_get($row, 'kode_skpd'),
                'nama_skpd' => data_get($row, 'nama_skpd'),
                'total_giat' => data_get($row, 'total_giat'),
                'belanja_terbuka' => data_get($row, 'belanja_terbuka'),
                'set_pagu_skpd' => data_get($row, 'set_pagu_skpd'),
                'set_pagu_giat' => data_get($row, 'set_pagu_giat'),
                'pagu_murni' => data_get($row, 'pagu_murni'),
                'rinci_giat' => data_get($row, 'rinci_giat'),
                'rincian_terbuka' => data_get($row, 'rincian_terbuka'),

                'status_getter' => false,
            ]);
        }
    }
}
