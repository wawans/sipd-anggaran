<?php

namespace App\Repositories\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

trait WithExportQuery
{
    public function exportQuery(Collection|Request $request)
    {
        $sortBy = $request->get($this->sortByName, $this->sortBy ?? null);
        $sortBy = $sortBy && Str::contains($sortBy, ',') ? collect(explode(',', $sortBy))->filter()->all() : $sortBy;
        $sortDirection = $request->get($this->sortDirectionName, $this->sortDirection ?? 'asc');
        $sortDirection = Str::contains($sortDirection, ',') ? collect(explode(',', $sortDirection))->filter()->all() : $sortDirection;

        $filters = $request->except([$this->perPageName, $this->pageName, $this->sortByName, $this->sortDirectionName]);

        return $this->query()
            ->when(method_exists($this, 'provideFilter') && ! blank($filters), function ($query) use ($filters) {
                $query->filter($filters, $this->provideFilter());
            })
            ->when(! method_exists($this, 'provideFilter') && property_exists($this, 'model') && method_exists($this->model, 'provideFilter') && ! blank($filters), function ($query) use ($filters) {
                $query->filter($filters);
            })
            ->when(! is_null($sortBy) && ! blank($sortBy), function ($query) use ($sortBy, $sortDirection) {
                /** @var Builder $query */
                if (is_array($sortBy) && is_array($sortDirection)) {
                    foreach ($sortBy as $index => $item) {
                        $query->orderBy($item, $sortDirection[$index] ?? 'asc');
                    }
                } elseif (is_array($sortBy) && ! is_array($sortDirection)) {
                    foreach ($sortBy as $item) {
                        $query->orderBy($item, $sortDirection);
                    }
                } else {
                    $query->orderBy($sortBy, $sortDirection);
                }
            });
    }

    public function export(Collection|Request|array|null $request)
    {
        return $this->exportQuery($request ?: collect())->get();
    }
}
