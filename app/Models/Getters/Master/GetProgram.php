<?php

namespace App\Models\Getters\Master;

use App\Support\Eloquent\Concerns\SingularTable;
use Illuminate\Database\Eloquent\Model;

class GetProgram extends Model
{
    use SingularTable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id_program',
        'tahun',
        'id_daerah',
        'id_urusan',
        'id_bidang_urusan',
        'kode_program',
        'nama_program',
        'no_program',
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
