<?php

namespace App\Models\Master;

use App\Support\Eloquent\Concerns\SingularTable;
use Illuminate\Database\Eloquent\Model;

class Giat extends Model
{
    use SingularTable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id_giat',
        'tahun',
        'id_daerah',
        'id_urusan',
        'id_bidang_urusan',
        'id_program',
        'kode_giat',
        'nama_giat',
        'no_giat',
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
