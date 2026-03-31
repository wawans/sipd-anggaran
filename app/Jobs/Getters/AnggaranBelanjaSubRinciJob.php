<?php

namespace App\Jobs\Getters;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class AnggaranBelanjaSubRinciJob implements ShouldQueue
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
            dispatch(new AnggaranBelanjaSubRinciChunkJob($row));
        }
    }
}
