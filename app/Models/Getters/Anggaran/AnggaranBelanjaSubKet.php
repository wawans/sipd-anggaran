<?php

namespace App\Models\Getters\Anggaran;

use App\Support\Eloquent\Concerns\SingularTable;
use Illuminate\Database\Eloquent\Model;

class AnggaranBelanjaSubKet extends Model
{
    use SingularTable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id_ket_sub_bl',
        'id_bl',
        'id_sub_bl',
        'tahun',
        'id_daerah',
        'id_unit',
        'id_skpd',
        'id_sub_skpd',
        'id_program',
        'id_giat',
        'id_sub_giat',
        'ket_bl_teks',
        'nama_bl',
        'nama_sub_bl',
        'nama_daerah',
        'nama_unit',
        'nama_skpd',
        'nama_sub_skpd',
        'nama_program',
        'nama_giat',
        'nama_sub_giat',
        'kode_daerah',
        'kode_unit',
        'kode_skpd',
        'kode_sub_skpd',
        'kode_program',
        'kode_giat',
        'kode_sub_giat',
        'id_jadwal',

    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [

        ];
    }
}
