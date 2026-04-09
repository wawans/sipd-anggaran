<?php

namespace App\Models\Getters\Master;

use App\Support\Eloquent\Concerns\SingularTable;
use Illuminate\Database\Eloquent\Model;

class GetGiatSub extends Model
{
    use SingularTable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id_sub_giat',
        'tahun',
        'id_daerah',
        'id_urusan',
        'id_bidang_urusan',
        'id_program',
        'id_giat',
        'kode_sub_giat',
        'nama_sub_giat',
        'no_sub_giat',
        'indikator',
        'kinerja',
        'satuan',
        'jenis_sub_giat',
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
