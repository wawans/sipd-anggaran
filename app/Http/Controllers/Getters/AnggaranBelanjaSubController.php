<?php

namespace App\Http\Controllers\Getters;

use App\Http\Controllers\Controller;
use App\Models\Getters\GetAnggaranBelanjaSub;
use Illuminate\Http\Request;

class AnggaranBelanjaSubController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = GetAnggaranBelanjaSub::query()->where('status_getter', true)
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
            GetAnggaranBelanjaSub::updateOrCreate([
                'tahun' => data_get($row, 'tahun'),
                'id_daerah' => data_get($row, 'id_daerah'),
                'id_sub_bl' => data_get($row, 'id_sub_bl'),
            ], [
                'id_unit' => data_get($row, 'id_unit'),
                'id_skpd' => data_get($row, 'id_skpd'),
                'kode_skpd' => data_get($row, 'kode_skpd'),
                'nama_skpd' => data_get($row, 'nama_skpd'),
                'id_urusan' => data_get($row, 'id_urusan'),
                'kode_urusan' => data_get($row, 'kode_urusan'),
                'nama_urusan' => data_get($row, 'nama_urusan'),
                'id_bidang_urusan' => data_get($row, 'id_bidang_urusan'),
                'kode_bidang_urusan' => data_get($row, 'kode_bidang_urusan'),
                'nama_bidang_urusan' => data_get($row, 'nama_bidang_urusan'),
                'id_sub_skpd' => data_get($row, 'id_sub_skpd'),
                'kode_sub_skpd' => data_get($row, 'kode_sub_skpd'),
                'nama_sub_skpd' => data_get($row, 'nama_sub_skpd'),
                'id_program' => data_get($row, 'id_program'),
                'kode_program' => data_get($row, 'kode_program'),
                'nama_program' => data_get($row, 'nama_program'),
                'id_giat' => data_get($row, 'id_giat'),
                'kode_giat' => data_get($row, 'kode_giat'),
                'nama_giat' => data_get($row, 'nama_giat'),
                'pagu_giat' => data_get($row, 'pagu_giat'),
                'rinci_giat' => data_get($row, 'rinci_giat'),
                'id_sub_giat' => data_get($row, 'id_sub_giat'),
                'kode_sub_giat' => data_get($row, 'kode_sub_giat'),
                'nama_sub_giat' => data_get($row, 'nama_sub_giat'),
                'pagu_murni' => data_get($row, 'pagu_murni'),
                'pagu' => data_get($row, 'pagu'),
                'pagu_indikatif' => data_get($row, 'pagu_indikatif'),
                'rincian' => data_get($row, 'rincian'),
                'kode_bl' => data_get($row, 'kode_bl'),
                'kode_sbl' => data_get($row, 'kode_sbl'),
                'kunci_bl' => data_get($row, 'kunci_bl'),
                'kunci_bl_rinci' => data_get($row, 'kunci_bl_rinci'),
                'is_locked' => data_get($row, 'is_locked'),

                'status_getter' => false,
            ]);
        }
    }
}
