<?php

namespace App\Jobs\Master;

use App\Repositories\Getters\Master\SkpdRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SkpdJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public array $data) {}

    /**
     * Execute the job.
     */
    public function handle(SkpdRepository $repository): void
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
