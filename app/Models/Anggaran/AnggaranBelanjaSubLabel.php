<?php

namespace App\Models\Anggaran;

use App\Support\Eloquent\Concerns\SingularTable;
use Illuminate\Database\Eloquent\Model;

class AnggaranBelanjaSubLabel extends Model
{
    use SingularTable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id_label_bl',
        'tahun',
        'id_daerah',
        'id_unit',
        'id_bl',
        'id_sub_bl',
        'id_label_pusat',
        'id_label_prov',
        'id_label_kokab',
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
