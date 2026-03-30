<?php

namespace App\Repositories\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;

trait WithTable
{
    /**
     * Pagination page `selector` name.
     *
     * @var string
     */
    public $pageName = 'page';

    /**
     * Pagination per page count `selector` name.
     *
     * @var string
     */
    public $perPageName = 'perPage';

    /**
     * Pagination per page count default value.
     *
     * @var string
     */
    public $perPage = 15;

    /**
     * Filter sort by `selector` name.
     *
     * @var string|array|null
     */
    public $sortByName = 'sortBy';

    /**
     * Filter sort direction `selector` name.
     *
     * @var string|array|null asc or desc
     */
    public $sortDirectionName = 'sortDirection';

    /**
     * Paginate the given query.
     *
     * @var bool
     */
    public $withPagination = true;

    public function tableWithPagination($value = true)
    {
        return tap($this, function () use ($value) {
            $this->withPagination = $value;
        });
    }

    public function tableWithoutPagination($value = false)
    {
        return tap($this, function () use ($value) {
            $this->withPagination = $value;
        });
    }

    public function tableQuery()
    {
        return $this->query();
    }

    public function table(Request $request, ?callable $callback = null)
    {
        $perPage = $request->get($this->perPageName, $this->perPage);
        $page = $request->get($this->pageName, 1);

        $sortBy = $request->get($this->sortByName, $this->sortBy ?? null);
        $sortBy = $sortBy && Str::contains($sortBy, ',') ? collect(explode(',', $sortBy))->filter()->all() : $sortBy;
        $sortDirection = $request->get($this->sortDirectionName, $this->sortDirection ?? 'asc');
        $sortDirection = Str::contains($sortDirection, ',') ? collect(explode(',', $sortDirection))->filter()->all() : $sortDirection;

        $filters = $request->except([$this->perPageName, $this->pageName, $this->sortByName, $this->sortDirectionName]);

        $query = $this->tableQuery()
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

        $result = $this->withPagination
            ? $this->toTableWithPagination($query, $perPage, $page, $callback)
            : $this->toTableWithoutPagination($query, $callback);

        $d = [
            $this->sortByName => $sortBy,
            $this->sortDirectionName => $sortDirection,
        ];

        return collect(['filters' => array_merge($d, $filters)])->merge($result);
    }

    private function toTableWithPagination($query, $perPage, $page, ?callable $callback = null)
    {
        /** @var Builder $query */
        return $query
            ->simplePaginate($perPage, ['*'], $this->pageName, $page)
            ->onEachSide(2)
            ->withQueryString()
            ->through(
                $callback instanceof \Closure ? $callback : [
                    $this, isset($callback) && method_exists($this, $callback) ? $callback : 'toArray',
                ]
            );
    }

    private function toTableWithoutPagination($query, ?callable $callback = null)
    {
        /** @var Builder $query */
        $data = $query->get();
        $total = count($data);

        /** @var LengthAwarePaginator($data, $total, $total) $paginator */
        $paginator = new Paginator($data, $total, null, [
            'path' => Paginator::resolveCurrentPath(),
        ]);

        return $paginator
            ->withQueryString()
            ->through(
                $callback instanceof \Closure ? $callback : [
                    $this, isset($callback) && method_exists($this, $callback) ? $callback : 'toArray',
                ]
            );
    }

    public function toArray($model)
    {
        return array_merge($model instanceof \stdClass ? get_object_vars($model) : $model->toArray(),
            $model->timestamps ? [
                $model->getCreatedAtColumn() => $model->{$model->getCreatedAtColumn()}?->toDateTimeString(),
                $model->getUpdatedAtColumn() => $model->{$model->getUpdatedAtColumn()}?->toDateTimeString(),
            ] : [],
        );
    }
}
