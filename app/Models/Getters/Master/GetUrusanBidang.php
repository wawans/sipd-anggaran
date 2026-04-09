<?php

namespace App\Models\Getters\Master;

use App\Support\Eloquent\Concerns\SingularTable;
use Illuminate\Database\Eloquent\Model;

class GetUrusanBidang extends Model
{
    use SingularTable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id_bidang_urusan',
        'tahun',
        'id_daerah',
        'id_urusan',
        'id_fungsi',
        'kode_bidang_urusan',
        'nama_bidang_urusan',
        'bidang_urusan_alias',
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
