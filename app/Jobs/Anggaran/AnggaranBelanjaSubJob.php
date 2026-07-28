<?php

namespace App\Jobs\Anggaran;

use App\Jobs\Concerns\JadwalAktif;
use App\Models\Anggaran\AnggaranBelanjaSub;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Arr;

class AnggaranBelanjaSubJob implements ShouldQueue
{
    use JadwalAktif;
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public array $data)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $datum = Arr::first($this->data);
        $jadwal = $this->getJadwalAktif(data_get($datum, 'tahun', now()->year));

        foreach ($this->data as $row) {
            AnggaranBelanjaSub::updateOrCreate([
                'tahun' => data_get($row, 'tahun'),
                'id_daerah' => data_get($row, 'id_daerah'),
                'id_jadwal' => $jadwal->id_jadwal,
                'id_sub_bl' => data_get($row, 'id_sub_bl'),
            ], [
                'id_unit' => data_get($row, 'id_unit'),
                'id_skpd' => data_get($row, 'id_skpd'),
                'kode_skpd' => data_get($row, 'kode_skpd'),
                'nama_skpd' => data_get($row, 'nama_skpd'),
                'id_urusan' => data_get($row, 'id_urusan'),
                'kode_urusan' => data_get($row, 'kode_urusan'),
                'nama_urusan' => data_get($row, 'nama_urusan'),
                'id_bidang_urusan' => data_get($row, 'id_bidang_urusan'),
                'kode_bidang_urusan' => data_get($row, 'kode_bidang_urusan'),
                'nama_bidang_urusan' => data_get($row, 'nama_bidang_urusan'),
                'id_sub_skpd' => data_get($row, 'id_sub_skpd'),
                'kode_sub_skpd' => data_get($row, 'kode_sub_skpd'),
                'nama_sub_skpd' => data_get($row, 'nama_sub_skpd'),
                'id_program' => data_get($row, 'id_program'),
                'kode_program' => data_get($row, 'kode_program'),
                'nama_program' => data_get($row, 'nama_program'),
                'id_giat' => data_get($row, 'id_giat'),
                'kode_giat' => data_get($row, 'kode_giat'),
                'nama_giat' => data_get($row, 'nama_giat'),
                'pagu_giat' => data_get($row, 'pagu_giat'),
                'rinci_giat' => data_get($row, 'rinci_giat'),
                'id_sub_giat' => data_get($row, 'id_sub_giat'),
                'kode_sub_giat' => data_get($row, 'kode_sub_giat'),
                'nama_sub_giat' => data_get($row, 'nama_sub_giat'),
                'pagu_murni' => data_get($row, 'pagu_murni'),
                'pagu' => data_get($row, 'pagu'),
                'pagu_indikatif' => data_get($row, 'pagu_indikatif'),
                'rincian' => data_get($row, 'rincian'),
                'kode_bl' => data_get($row, 'kode_bl'),
                'kode_sbl' => data_get($row, 'kode_sbl'),
                'kunci_bl' => data_get($row, 'kunci_bl'),
                'kunci_bl_rinci' => data_get($row, 'kunci_bl_rinci'),
                'is_locked' => data_get($row, 'is_locked'),

                'status_getter' => true,
            ]);
        }
    }
}
