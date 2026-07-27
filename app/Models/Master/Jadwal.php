<?php

namespace App\Models\Master;

use App\Support\Eloquent\Concerns\SingularTable;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use SingularTable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id_jadwal',
        'tahun',
        'id_daerah',
        'id_tahap',
        'nama_sub_tahap',
        'waktu_mulai',
        'waktu_selesai',
        'is_perubahan',
        'id_jadwal_murni',
        'is_pembahasan',
        'id_jadwal_pembahasan',
        'is_locked',
        'is_public',
        'is_rinci_bl',
        'id_sub_rkpd',
        'no_registrasi',
        'no_perda',
        'tgl_perda',
        'no_perkada',
        'tgl_perkada',
        'tgl_rka',
        'tandai_jadwal',
        'id_jadwal_rpjmd',
        'rkpd_murni',
        'rkpd_pak',
        'kua_murni',
        'kua_pak',
        'rollback_jadwal',
        'rollback_teks',
        'geser_khusus',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'waktu_mulai' => 'datetime',
            'waktu_selesai' => 'datetime',
            'tgl_perda' => 'date',
            'tgl_perkada' => 'date',
            'tgl_rka' => 'date',
        ];
    }
}
