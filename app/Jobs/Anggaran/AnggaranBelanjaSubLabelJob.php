<?php

namespace App\Jobs\Anggaran;

use App\Repositories\Anggaran\AnggaranBelanjaSubLabelRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class AnggaranBelanjaSubLabelJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public array $data) {}

    /**
     * Execute the job.
     */
    public function handle(AnggaranBelanjaSubLabelRepository $repository): void
    {
        $rows = collect($this->data);

        if ($rows->count() > 100) {
            foreach ($rows->chunk(100) as $row) {
                dispatch(new self($row->toArray()));
            }
        } else {
            foreach ($rows as $row) {
                $repository->updateOrCreate($row);
            }
        }
    }
}
