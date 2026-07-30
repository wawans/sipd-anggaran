<?php

namespace App\Repositories\Concerns;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * WithExportQuery
 */
trait WithExportQuery
{
    public function exportQuery(Collection|Request $request)
    {
        return $this->tableQuery($request);
    }

    public function export(Collection|Request $request)
    {
        foreach ($this->model::cursor() as $row) {
            yield $row;
        }
    }
}
