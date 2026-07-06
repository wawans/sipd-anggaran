<?php

namespace App\Models\Getters\Anggaran;

use App\Support\Eloquent\Concerns\SingularTable;
use Illuminate\Database\Eloquent\Model;

class AnggaranBelanjaSub extends Model
{
    use SingularTable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id_sub_bl',
        'id_daerah',
        'tahun',
        'id_unit',
        'id_skpd',
        'kode_skpd',
        'nama_skpd',
        'id_urusan',
        'kode_urusan',
        'nama_urusan',
        'id_bidang_urusan',
        'kode_bidang_urusan',
        'nama_bidang_urusan',
        'id_sub_skpd',
        'kode_sub_skpd',
        'nama_sub_skpd',
        'id_program',
        'kode_program',
        'nama_program',
        'id_giat',
        'kode_giat',
        'nama_giat',
        'pagu_giat',
        'rinci_giat',
        'id_sub_giat',
        'kode_sub_giat',
        'nama_sub_giat',
        'pagu_murni',
        'pagu',
        'pagu_indikatif',
        'rincian',
        'kode_bl',
        'kode_sbl',
        'kunci_bl',
        'kunci_bl_rinci',
        'is_locked',
        'status_getter',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'pagu_murni' => 'float',
            'pagu' => 'float',
            'pagu_indikatif' => 'float',
            'pagu_giat' => 'float',
            'rinci_giat' => 'float',
            'rincian' => 'float',
            'kunci_bl' => 'boolean',
            'kunci_bl_rinci' => 'boolean',
            'is_locked' => 'boolean',
            'status_getter' => 'boolean',
        ];
    }
}
