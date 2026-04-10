<?php

namespace App\Jobs\Getters\Anggaran;

use App\Repositories\Getters\Anggaran\GetAnggaranBelanjaSubLabelRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class GetAnggaranBelanjaSubLabelJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public array $data) {}

    /**
     * Execute the job.
     */
    public function handle(GetAnggaranBelanjaSubLabelRepository $repository): void
    {
        $rows = collect($this->data);

        if ($rows->count() > 100) {
            foreach ($rows->chunk(100) as $row) {
                dispatch(new self((array) $row));
            }
        } else {
            foreach ($rows as $row) {
                $repository->updateOrCreate($row);
            }
        }
    }
}
