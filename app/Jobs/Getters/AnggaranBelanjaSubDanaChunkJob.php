<?php

namespace App\Jobs\Getters;

use App\Models\Getters\GetAnggaranBelanjaSubDana;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Collection;

class AnggaranBelanjaSubDanaChunkJob implements ShouldQueue
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
            GetAnggaranBelanjaSubDana::updateOrCreate([
                'id_dana_sub_bl' => data_get($row, 'id_dana_sub_bl'),
                'tahun' => data_get($row, 'tahun'),
            ], [

                'id_daerah' => data_get($row, 'id_daerah'),
                'id_unit' => data_get($row, 'id_unit'),
                'id_bl' => data_get($row, 'id_bl'),
                'id_sub_bl' => data_get($row, 'id_sub_bl'),
                'id_dana' => data_get($row, 'id_dana'),
                'id_skpd' => data_get($row, 'id_skpd'),
                'id_sub_skpd' => data_get($row, 'id_sub_skpd'),
                'id_program' => data_get($row, 'id_program'),
                'id_giat' => data_get($row, 'id_giat'),
                'id_sub_giat' => data_get($row, 'id_sub_giat'),
                'kode_dana' => data_get($row, 'kode_dana'),
                'nama_dana' => data_get($row, 'nama_dana'),
                'pagu_dana' => data_get($row, 'pagu_dana'),
                'nama_daerah' => data_get($row, 'nama_daerah'),
                'nama_unit' => data_get($row, 'nama_unit'),
                'nama_bl' => data_get($row, 'nama_bl'),
                'nama_sub_bl' => data_get($row, 'nama_sub_bl'),
                'nama_skpd' => data_get($row, 'nama_skpd'),
                'nama_sub_skpd' => data_get($row, 'nama_sub_skpd'),
                'nama_program' => data_get($row, 'nama_program'),
                'nama_giat' => data_get($row, 'nama_giat'),
                'nama_sub_giat' => data_get($row, 'nama_sub_giat'),
                'kode_unit' => data_get($row, 'kode_unit'),
                'kode_sub_skpd' => data_get($row, 'kode_sub_skpd'),
                'kode_program' => data_get($row, 'kode_program'),
                'kode_giat' => data_get($row, 'kode_giat'),
                'kode_sub_giat' => data_get($row, 'kode_sub_giat'),
                'id_jadwal' => data_get($row, 'id_jadwal'),
                'is_locked' => data_get($row, 'is_locked'),
            ]);
        }
    }
}
