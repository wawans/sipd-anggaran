<?php

namespace App\Models\Getters;

use Illuminate\Database\Eloquent\Model;

class GetAnggaranBelanjaSubSub extends Model
{
    protected $table = 'get_anggaran_belanja_sub_sub';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id_subs_sub_bl',
        'id_bl',
        'id_sub_bl',
        'tahun',
        'id_daerah',
        'id_unit',
        'subs_bl_teks',
        'is_paket',
        'id_jenis_barjas',
        'id_metode_barjas',
        'id_skpd',
        'id_sub_skpd',
        'id_program',
        'id_giat',
        'id_sub_giat',
        'nama_bl',
        'nama_sub_bl',

    ];
}
