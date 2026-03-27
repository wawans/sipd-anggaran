<?php

namespace App\Http\Controllers\Getters;

use App\Http\Controllers\Controller;
use App\Models\Getters\GetAnggaranBelanjaSubSub;
use Illuminate\Http\Request;

class AnggaranBelanjaSubSubController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = GetAnggaranBelanjaSubSub::query()->where('status_getter', true)
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
            GetAnggaranBelanjaSubSub::updateOrCreate([
                'id_subs_sub_bl' => data_get($row, 'id_subs_sub_bl'),
                'id_bl' => data_get($row, 'id_bl'),
                'id_sub_bl' => data_get($row, 'id_sub_bl'),
                'tahun' => data_get($row, 'tahun'),
            ], [
                'id_daerah' => data_get($row, 'id_daerah'),
                'id_unit' => data_get($row, 'id_unit'),
                'subs_bl_teks' => data_get($row, 'subs_bl_teks'),
                'is_paket' => data_get($row, 'is_paket'),
                'id_jenis_barjas' => data_get($row, 'id_jenis_barjas'),
                'id_metode_barjas' => data_get($row, 'id_metode_barjas'),
                'id_skpd' => data_get($row, 'id_skpd'),
                'id_sub_skpd' => data_get($row, 'id_sub_skpd'),
                'id_program' => data_get($row, 'id_program'),
                'id_giat' => data_get($row, 'id_giat'),
                'id_sub_giat' => data_get($row, 'id_sub_giat'),
                'nama_bl' => data_get($row, 'nama_bl'),
                'nama_sub_bl' => data_get($row, 'nama_sub_bl'),
            ]);
        }
    }
}
