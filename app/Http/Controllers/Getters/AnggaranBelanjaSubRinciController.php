<?php

namespace App\Http\Controllers\Getters;

use App\Http\Controllers\Controller;
use App\Models\Getters\GetAnggaranBelanjaSubRinci;
use Illuminate\Http\Request;

class AnggaranBelanjaSubRinciController extends Controller
{
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
        $validated = $request->validate(['data' => ['required', 'array']]);

        defer(fn () => $this->handle($validated['data']));

        return response()->json(['status' => true]);
    }

    private function handle(array $data)
    {
        foreach ($data as $row) {
            $m = GetAnggaranBelanjaSubRinci::updateOrCreate([
                'id_rinci_sub_bl' => data_get($row, 'id_rinci_sub_bl'),
                'id_subs_sub_bl' => data_get($row, 'id_subs_sub_bl'),
                'id_ket_sub_bl' => data_get($row, 'id_ket_sub_bl'),
                'id_sub_bl' => data_get($row, 'id_sub_bl'),
                'tahun' => data_get($row, 'tahun'),
            ], [

                'id_daerah' => data_get($row, 'id_daerah'),
                'id_standar_harga' => data_get($row, 'id_standar_harga'),
                'kode_standar_harga' => data_get($row, 'kode_standar_harga'),
                'nama_standar_harga' => data_get($row, 'nama_standar_harga'),
                'koefisien' => data_get($row, 'koefisien'),
                'koefisien_volume_1' => data_get($row, 'koefisien_volume_1'),
                'koefisien_satuan_1' => data_get($row, 'koefisien_satuan_1'),
                'koefisien_volume_2' => data_get($row, 'koefisien_volume_2'),
                'koefisien_satuan_2' => data_get($row, 'koefisien_satuan_2'),
                'koefisien_volume_3' => data_get($row, 'koefisien_volume_3'),
                'koefisien_satuan_3' => data_get($row, 'koefisien_satuan_3'),
                'koefisien_volume_4' => data_get($row, 'koefisien_volume_4'),
                'koefisien_satuan_4' => data_get($row, 'koefisien_satuan_4'),
                'harga_satuan' => data_get($row, 'harga_satuan'),
                'total_harga' => data_get($row, 'total_harga'),
                'id_akun' => data_get($row, 'id_akun'),
                'kode_akun' => data_get($row, 'kode_akun'),
                'nama_akun' => data_get($row, 'nama_akun'),
                'spek' => data_get($row, 'spek'),
                'akun_locked' => data_get($row, 'akun_locked'),
                'ssh_locked' => data_get($row, 'ssh_locked'),
                'penerima_bantuan' => data_get($row, 'penerima_bantuan'),
                'koefisien_murni' => data_get($row, 'koefisien_murni'),
                'koefisien_murni_volume_1' => data_get($row, 'koefisien_murni_volume_1'),
                'koefisien_murni_satuan_1' => data_get($row, 'koefisien_murni_satuan_1'),
                'koefisien_murni_volume_2' => data_get($row, 'koefisien_murni_volume_2'),
                'koefisien_murni_satuan_2' => data_get($row, 'koefisien_murni_satuan_2'),
                'koefisien_murni_volume_3' => data_get($row, 'koefisien_murni_volume_3'),
                'koefisien_murni_satuan_3' => data_get($row, 'koefisien_murni_satuan_3'),
                'koefisien_murni_volume_4' => data_get($row, 'koefisien_murni_volume_4'),
                'koefisien_murni_satuan_4' => data_get($row, 'koefisien_murni_satuan_4'),
                'harga_satuan_murni' => data_get($row, 'harga_satuan_murni'),
                'total_harga_murni' => data_get($row, 'total_harga_murni'),
            ]);

            $this->split($m);
        }
    }

    private function split(GetAnggaranBelanjaSubRinci $model)
    {
        $ks = explode(' x ', trim($model->koefisien));
        $a = [];
        foreach ($ks as $i => $k) {
            $n = collect(explode(' ', trim($k), 2));

            $a['koefisien_volume_'.($i + 1)] = $n->first() ?? '';
            $a['koefisien_satuan_'.($i + 1)] = $n->count() > 1 ? $n->last() : '';
        }

        $ks = explode(' x ', trim($model->koefisien_murni));
        foreach ($ks as $i => $k) {
            $n = collect(explode(' ', trim($k), 2));

            $a['koefisien_murni_volume_'.($i + 1)] = $n->first() ?? '';
            $a['koefisien_murni_satuan_'.($i + 1)] = $n->count() > 1 ? $n->last() : '';
        }

        $model->forceFill($a);
        $model->save();
    }
}
