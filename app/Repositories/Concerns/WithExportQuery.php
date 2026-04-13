<?php

namespace App\Repositories\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * WithExportQuery
 *
 * @property bool $withGenerator
 */
trait WithExportQuery
{
    /**
     * Export using generator.
     *
     * @var bool
     */
    // abstract public bool $withGenerator = false;

    public function exportWithGenerator($value = true)
    {
        return tap($this, function () use ($value) {
            $this->withGenerator = $value;
        });
    }

    public function exportWithoutGenerator($value = false)
    {
        return tap($this, function () use ($value) {
            $this->withGenerator = $value;
        });
    }

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

    public function exportGenerator(Collection|Request $request)
    {
        foreach ($this->model::cursor() as $row) {
            yield $row;
        }
    }

    public function export(Collection|Request|array|null $request)
    {
        if (! $this->useGenerator()) {
            return $this->exportQuery($request ?: collect())->get();
        }

        $this->exportGenerator($request);
    }

    public function useGenerator(): bool
    {
        return property_exists($this, 'withGenerator') ? $this->withGenerator : false;
    }
}
