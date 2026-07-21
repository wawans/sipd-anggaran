<?php

namespace App\Models\Anggaran;

use App\Support\Eloquent\Concerns\SingularTable;
use Illuminate\Database\Eloquent\Model;

class AnggaranBelanjaSubDana extends Model
{
    use SingularTable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id_dana_sub_bl',
        'tahun',
        'id_daerah',
        'id_unit',
        'id_bl',
        'id_sub_bl',
        'id_dana',
        'id_skpd',
        'id_sub_skpd',
        'id_program',
        'id_giat',
        'id_sub_giat',
        'kode_dana',
        'nama_dana',
        'pagu_dana',
        'nama_daerah',
        'nama_unit',
        'nama_bl',
        'nama_sub_bl',
        'nama_skpd',
        'nama_sub_skpd',
        'nama_program',
        'nama_giat',
        'nama_sub_giat',
        'kode_unit',
        'kode_sub_skpd',
        'kode_program',
        'kode_giat',
        'kode_sub_giat',
        'id_jadwal',
        'is_locked',

    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'pagu_dana' => 'float',
        ];
    }
}
