<?php

namespace App\Repositories\Concerns;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Spatie\QueryBuilder\QueryBuilder;

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

    public function tableQuery()
    {
        return QueryBuilder::for($this->query());
    }

    public function table(Request $request, ?callable $callback = null)
    {
        $withPagination = request()->has($this->perPageName) || request()->has($this->pageName);

        $perPage = $request->get($this->perPageName, $this->perPage);
        $page = $request->get($this->pageName, 1);

        $query = $this->tableQuery();

        $paginator = $withPagination
            ? $query->simplePaginate($perPage, ['*'], $this->pageName, $page)
            : (new Paginator($items = $query->get(), count($items), null, [
                'path' => Paginator::resolveCurrentPath(),
            ]));

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
