<?php

namespace App\Repositories\Concerns;

use Illuminate\Support\Facades\Cache;

trait GetterUpdateOrCreate
{
    public function getterKeys(): array
    {
        return [
            //
        ];
    }

    public function updateOrCreate(array $data)
    {
        $attributes = collect($data);
        $fillable = collect($this->model->getFillable());
        $keys = $this->getterKeys();

        $values = $attributes->only(
            $fillable->filter(fn ($item) => in_array($item, $keys))
        )->toArray();
        $update = $attributes->only($fillable->except($keys)->toArray())->toArray();
        $key = (string) collect($values)->flatten()->join('.');

        if ($model = Cache::get($this->model->getTable().'#'.$key)) {
            $model->fill($update);

            if (! $model->isDirty()) {
                return $model;
            }
        }

        $model = $this->model->updateOrCreate($values, $update);

        Cache::set($this->model->getTable().'#'.$key, $model, now()->addDay());

        return $model;
    }
}
