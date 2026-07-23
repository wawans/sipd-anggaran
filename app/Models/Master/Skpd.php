<?php

namespace App\Models\Master;

use App\Support\Eloquent\Concerns\SingularTable;
use Illuminate\Database\Eloquent\Model;

class Skpd extends Model
{
    use SingularTable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id_skpd',
        'tahun',
        'id_daerah',
        'id_unit',
        'kode_unit',
        'kode_skpd',
        'nama_skpd',
        'kode_opd',
        'nama_kepala',
        'nip_kepala',
        'pangkat_kepala',
        'status_kepala',
        'id_strategi',
        'id_bidang_urusan_1',
        'id_bidang_urusan_2',
        'id_bidang_urusan_3',
        'is_ppkd',
        'is_skpd',
        'is_pendapatan',
        'is_pembiayaan',
        'is_dpa_khusus',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            //
        ];
    }
}
