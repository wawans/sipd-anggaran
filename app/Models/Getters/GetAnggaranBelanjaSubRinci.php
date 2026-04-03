<?php

namespace App\Models\Getters;

use Illuminate\Database\Eloquent\Model;

class GetAnggaranBelanjaSubRinci extends Model
{
    protected $table = 'get_anggaran_belanja_sub_rinci';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id_rinci_sub_bl',
        'id_subs_sub_bl',
        'id_ket_sub_bl',
        'id_sub_bl',
        'tahun',
        'id_daerah',
        'id_standar_harga',
        'kode_standar_harga',
        'nama_standar_harga',
        'koefisien',
        'koefisien_volume_1',
        'koefisien_satuan_1',
        'koefisien_volume_2',
        'koefisien_satuan_2',
        'koefisien_volume_3',
        'koefisien_satuan_3',
        'koefisien_volume_4',
        'koefisien_satuan_4',
        'harga_satuan',
        'total_harga',
        'id_akun',
        'kode_akun',
        'nama_akun',
        'spek',
        'akun_locked',
        'ssh_locked',
        'penerima_bantuan',
        'koefisien_murni',
        'koefisien_murni_volume_1',
        'koefisien_murni_satuan_1',
        'koefisien_murni_volume_2',
        'koefisien_murni_satuan_2',
        'koefisien_murni_volume_3',
        'koefisien_murni_satuan_3',
        'koefisien_murni_volume_4',
        'koefisien_murni_satuan_4',
        'harga_satuan_murni',
        'total_harga_murni',

    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'harga_satuan' => 'float',
            'total_harga' => 'float',
            'harga_satuan_murni' => 'float',
            'total_harga_murni' => 'float',
        ];
    }
}
