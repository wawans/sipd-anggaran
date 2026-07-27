<?php

namespace App\Models\Anggaran;

use App\Support\Eloquent\Concerns\SingularTable;
use Illuminate\Database\Eloquent\Model;

class AnggaranSkpd extends Model
{
    use SingularTable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'tahun',
        'id_daerah',
        'id_jadwal',
        'id_skpd',
        'id_unit',
        'kode_skpd',
        'nama_skpd',
        'set_pagu_skpd',
        'set_pagu_giat',
        'pagu_murni',
        'rinci_giat',
        'total_giat',
        'belanja_terbuka',
        'rincian_terbuka',
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
            'set_pagu_skpd' => 'float',
            'set_pagu_giat' => 'float',
            'pagu_murni' => 'float',
            'rinci_giat' => 'float',
            'status_getter' => 'boolean',
        ];
    }
}
