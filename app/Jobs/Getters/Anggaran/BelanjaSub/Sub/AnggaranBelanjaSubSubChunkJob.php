<?php

namespace App\Jobs\Getters\Anggaran\BelanjaSub\Sub;

use App\Models\Getters\GetAnggaranBelanjaSubSub;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Collection;

class AnggaranBelanjaSubSubChunkJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Collection|array $data)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->data as $row) {
            GetAnggaranBelanjaSubSub::updateOrCreate([
                'id_subs_sub_bl' => data_get($row, 'id_subs_sub_bl'),
                'id_bl' => data_get($row, 'id_bl'),
                'id_sub_bl' => data_get($row, 'id_sub_bl'),
                'tahun' => data_get($row, 'tahun'),
            ], [
                'id_daerah' => data_get($row, 'id_daerah'),
                'id_unit' => data_get($row, 'id_unit'),
                'subs_bl_teks' => data_get($row, 'subs_bl_teks'),
                'is_paket' => data_get($row, 'is_paket'),
                'id_jenis_barjas' => data_get($row, 'id_jenis_barjas'),
                'id_metode_barjas' => data_get($row, 'id_metode_barjas'),
                'id_skpd' => data_get($row, 'id_skpd'),
                'id_sub_skpd' => data_get($row, 'id_sub_skpd'),
                'id_program' => data_get($row, 'id_program'),
                'id_giat' => data_get($row, 'id_giat'),
                'id_sub_giat' => data_get($row, 'id_sub_giat'),
                'nama_bl' => data_get($row, 'nama_bl'),
                'nama_sub_bl' => data_get($row, 'nama_sub_bl'),
            ]);
        }
    }
}
