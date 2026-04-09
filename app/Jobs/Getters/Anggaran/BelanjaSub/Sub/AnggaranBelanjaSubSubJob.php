<?php

namespace App\Jobs\Getters\Anggaran\BelanjaSub\Sub;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class AnggaranBelanjaSubSubJob implements ShouldQueue
{
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
        $rows = collect($this->data);

        foreach ($rows->chunk(100) as $row) {
            dispatch(new AnggaranBelanjaSubSubChunkJob($row));
        }
    }
}
