<?php

namespace App\Models\Getters\Anggaran;

use App\Support\Eloquent\Concerns\SingularTable;
use Illuminate\Database\Eloquent\Model;

class AnggaranBelanjaSubDetilLokasi extends Model
{
    use SingularTable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id_detil_lokasi',
        'tahun',
        'id_daerah',
        'id_unit',
        'id_bl',
        'id_sub_bl',
        'id_kab_kota',
        'id_camat',
        'id_lurah',
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
