<?php

namespace App\Models\Master;

use App\Support\Eloquent\Concerns\SingularTable;
use Illuminate\Database\Eloquent\Model;

class SkpdSub extends Model
{
    use SingularTable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id_sub_skpd',
        'tahun',
        'id_daerah',
        'kode_sub_skpd',
        'nama_sub_skpd',
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
