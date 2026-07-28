<?php

namespace App\Jobs\Anggaran;

use App\Jobs\Concerns\JadwalAktif;
use App\Models\Anggaran\AnggaranSkpd;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Arr;

class AnggaranSkpdJob implements ShouldQueue
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
            AnggaranSkpd::updateOrCreate([
                'tahun' => data_get($row, 'tahun'),
                'id_daerah' => data_get($row, 'id_daerah'),
                'id_jadwal' => $jadwal->id_jadwal,
                'id_skpd' => data_get($row, 'id_skpd'),
                'id_unit' => data_get($row, 'id_unit'),
            ], [
                'kode_skpd' => data_get($row, 'kode_skpd'),
                'nama_skpd' => data_get($row, 'nama_skpd'),
                'total_giat' => data_get($row, 'total_giat'),
                'belanja_terbuka' => data_get($row, 'belanja_terbuka'),
                'set_pagu_skpd' => data_get($row, 'set_pagu_skpd'),
                'set_pagu_giat' => data_get($row, 'set_pagu_giat'),
                'pagu_murni' => data_get($row, 'pagu_murni'),
                'rinci_giat' => data_get($row, 'rinci_giat'),
                'rincian_terbuka' => data_get($row, 'rincian_terbuka'),

                'status_getter' => true,
            ]);
        }
    }
}
