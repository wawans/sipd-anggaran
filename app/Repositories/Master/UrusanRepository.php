<?php

namespace App\Repositories\Master;

use App\Models\Master\Urusan;
use App\Repositories\Concerns\GetterUpdateOrCreate;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;

/**
 * \App\Repositories\Master\UrusanRepository
 *
 * @property Urusan $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\Master\Urusan query()
 * @method \App\Models\Master\Urusan update(array $attributes, \App\Models\Master\Urusan $urusan)
 */
class UrusanRepository extends Repository
{
    use GetterUpdateOrCreate;
    use WithExportQuery;
    use WithTable;

    /**
     * Create a new repository instance.
     */
    public function __construct(protected Urusan $model) {}

    /**
     * Create a new instance of the given model.
     *
     * @param  array  $attributes
     * @return Urusan
     */
    public function store($attributes)
    {
        return $this->create($attributes);
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return Urusan
     */
    public function edit($attributes, Urusan $urusan)
    {
        return $this->update($attributes, $urusan);
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null|void
     */
    public function destroy(Urusan $urusan)
    {
        return $this->delete($urusan);
    }

    /**
     * Delete the model(s) from the database.
     *
     * @param  list<string>  $keys
     * @return bool|null|void
     */
    public function destroys(array $keys)
    {
        return $this->query()->whereIn('id', $keys)->delete();
    }

    /*public function updateOrCreate(array $data)
    {
        $attributes = collect($data);
        $fillable = collect($this->model->getFillable());
        $keys = [
            'id_urusan',
            'tahun',
            'id_daerah',
        ];

        $values = $attributes->only($fillable->only($keys))->toArray();
        $update = $attributes->only($fillable->except($keys))->toArray();
        $key = http_build_query($values);

        if ($model = Cache::get($this->model->getTable().'#'.$key)) {
            $model->fill($update);

            if (! $model->isDirty()) {
                return $model;
            }
        }

        $model = $this->model->updateOrCreate($values, $update);

        Cache::set($this->model->getTable().'#'.$key, $model->withoutRelations());

        return $model;
    }*/

    public function getterKeys(): array
    {
        return [
            'id_urusan',
            'tahun',
            'id_daerah',
        ];
    }
}
