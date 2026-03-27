<?php

namespace App\Http\Controllers\Getters;

use App\Http\Controllers\Controller;
use App\Models\Getters\GetAnggaranBelanjaSubDana;
use Illuminate\Http\Request;

class AnggaranBelanjaSubDanaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = GetAnggaranBelanjaSubDana::query()->where('status_getter', true)
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
            GetAnggaranBelanjaSubDana::updateOrCreate([
                'id_dana_sub_bl' => data_get($row, 'id_dana_sub_bl'),
                'tahun' => data_get($row, 'tahun'),
            ], [

                'id_daerah' => data_get($row, 'id_daerah'),
                'id_unit' => data_get($row, 'id_unit'),
                'id_bl' => data_get($row, 'id_bl'),
                'id_sub_bl' => data_get($row, 'id_sub_bl'),
                'id_dana' => data_get($row, 'id_dana'),
                'id_skpd' => data_get($row, 'id_skpd'),
                'id_sub_skpd' => data_get($row, 'id_sub_skpd'),
                'id_program' => data_get($row, 'id_program'),
                'id_giat' => data_get($row, 'id_giat'),
                'id_sub_giat' => data_get($row, 'id_sub_giat'),
                'kode_dana' => data_get($row, 'kode_dana'),
                'nama_dana' => data_get($row, 'nama_dana'),
                'pagu_dana' => data_get($row, 'pagu_dana'),
                'nama_daerah' => data_get($row, 'nama_daerah'),
                'nama_unit' => data_get($row, 'nama_unit'),
                'nama_bl' => data_get($row, 'nama_bl'),
                'nama_sub_bl' => data_get($row, 'nama_sub_bl'),
                'nama_skpd' => data_get($row, 'nama_skpd'),
                'nama_sub_skpd' => data_get($row, 'nama_sub_skpd'),
                'nama_program' => data_get($row, 'nama_program'),
                'nama_giat' => data_get($row, 'nama_giat'),
                'nama_sub_giat' => data_get($row, 'nama_sub_giat'),
                'kode_unit' => data_get($row, 'kode_unit'),
                'kode_sub_skpd' => data_get($row, 'kode_sub_skpd'),
                'kode_program' => data_get($row, 'kode_program'),
                'kode_giat' => data_get($row, 'kode_giat'),
                'kode_sub_giat' => data_get($row, 'kode_sub_giat'),
                'id_jadwal' => data_get($row, 'id_jadwal'),
                'is_locked' => data_get($row, 'is_locked'),
            ]);
        }
    }
}
