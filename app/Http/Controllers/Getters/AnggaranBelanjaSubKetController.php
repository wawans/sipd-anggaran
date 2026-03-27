<?php

namespace App\Http\Controllers\Getters;

use App\Http\Controllers\Controller;
use App\Models\Getters\GetAnggaranBelanjaSubKet;
use Illuminate\Http\Request;

class AnggaranBelanjaSubKetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = GetAnggaranBelanjaSubKet::query()->where('status_getter', true)
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
            GetAnggaranBelanjaSubKet::updateOrCreate([
                'id_ket_sub_bl' => data_get($row, 'id_ket_sub_bl'),
                'id_bl' => data_get($row, 'id_bl'),
                'id_sub_bl' => data_get($row, 'id_sub_bl'),
                'tahun' => data_get($row, 'tahun'),

            ], [

                'id_daerah' => data_get($row, 'id_daerah'),
                'id_unit' => data_get($row, 'id_unit'),
                'id_skpd' => data_get($row, 'id_skpd'),
                'id_sub_skpd' => data_get($row, 'id_sub_skpd'),
                'id_program' => data_get($row, 'id_program'),
                'id_giat' => data_get($row, 'id_giat'),
                'id_sub_giat' => data_get($row, 'id_sub_giat'),
                'ket_bl_teks' => data_get($row, 'ket_bl_teks'),
                'nama_bl' => data_get($row, 'nama_bl'),
                'nama_sub_bl' => data_get($row, 'nama_sub_bl'),
                'nama_daerah' => data_get($row, 'nama_daerah'),
                'nama_unit' => data_get($row, 'nama_unit'),
                'nama_skpd' => data_get($row, 'nama_skpd'),
                'nama_sub_skpd' => data_get($row, 'nama_sub_skpd'),
                'nama_program' => data_get($row, 'nama_program'),
                'nama_giat' => data_get($row, 'nama_giat'),
                'nama_sub_giat' => data_get($row, 'nama_sub_giat'),
                'kode_daerah' => data_get($row, 'kode_daerah'),
                'kode_unit' => data_get($row, 'kode_unit'),
                'kode_skpd' => data_get($row, 'kode_skpd'),
                'kode_sub_skpd' => data_get($row, 'kode_sub_skpd'),
                'kode_program' => data_get($row, 'kode_program'),
                'kode_giat' => data_get($row, 'kode_giat'),
                'kode_sub_giat' => data_get($row, 'kode_sub_giat'),
                'id_jadwal' => data_get($row, 'id_jadwal'),
            ]);
        }
    }
}
