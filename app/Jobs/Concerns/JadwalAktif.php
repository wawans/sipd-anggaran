<?php

namespace App\Jobs\Concerns;

use App\Models\Master\Jadwal;
use Illuminate\Support\Facades\Cache;

trait JadwalAktif
{
    protected function getJadwalLatest($tahun)
    {
        return Jadwal::where('tahun', $tahun)->latest('waktu_selesai')->firstOrFail();
    }

    public function getJadwalAktif($tahun)
    {
        return Cache::remember("JadwalAktif{$tahun}", 60 * 3, function () use ($tahun) {
            return $this->getJadwalLatest($tahun);
        });
    }
}
