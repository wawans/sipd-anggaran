<?php

namespace App\Models\Getters;

use App\Support\Eloquent\Concerns\SingularTable;
use Illuminate\Database\Eloquent\Model;

class GetAkun extends Model
{
    use SingularTable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id_akun',
        'tahun',
        'id_daerah',
        'kode_akun',
        'nama_akun',
        'is_pendapatan',
        'is_bl',
        'is_pembiayaan',
        'is_gaji_asn',
        'is_barjas',
        'is_bunga',
        'is_subsidi',
        'is_bagi_hasil',
        'is_bankeu_umum',
        'is_bankeu_khusus',
        'is_btt',
        'is_hibah_brg',
        'is_hibah_uang',
        'is_sosial_brg',
        'is_sosial_uang',
        'is_bos',
        'is_modal_tanah',
        'is_tkdn',
        'is_miskin',
        'level',
        'mulai_tahun',
        'kunci_tahun',
        'ket_akun',
        'set_prov',
        'set_kab_kota',
        'id_jns_dana',
        'kode_akun_lama',
        'kode_akun_revisi',
        'pendapatan',
        'belanja',
        'pembiayaan',
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
