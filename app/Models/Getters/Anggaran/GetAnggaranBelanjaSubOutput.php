<?php

namespace App\Models\Getters\Anggaran;

use App\Support\Eloquent\Concerns\SingularTable;
use Illuminate\Database\Eloquent\Model;

class GetAnggaranBelanjaSubOutput extends Model
{
    use SingularTable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id_output_bl',
        'tahun',
        'id_daerah',
        'id_unit',
        'id_bl',
        'id_sub_bl',
        'tolak_ukur',
        'target',
        'satuan',
        'target_teks',
        'tolok_ukur_sub',
        'target_sub',
        'satuan_sub',
        'target_sub_teks',
        'id_skpd',
        'id_sub_skpd',
        'id_program',
        'id_giat',
        'id_sub_giat',
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
