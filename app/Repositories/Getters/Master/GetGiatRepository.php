<?php

namespace App\Repositories\Getters\Master;

use App\Models\Getters\GetGiat;
use App\Repositories\Concerns\GetterUpdateOrCreate;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;

/**
 * \App\Repositories\Getters\Master\GetGiatRepository
 *
 * @property GetGiat $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\Getters\GetGiat query()
 * @method \App\Models\Getters\GetGiat update(array $attributes, \App\Models\Getters\GetGiat $getGiat)
 */
class GetGiatRepository extends Repository
{
    use GetterUpdateOrCreate;
    use WithExportQuery;
    use WithTable;

    /**
     * Create a new repository instance.
     */
    public function __construct(protected GetGiat $model) {}

    /**
     * Create a new instance of the given model.
     *
     * @param  array  $attributes
     * @return GetGiat
     */
    public function store($attributes)
    {
        return $this->create($attributes);
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return GetGiat
     */
    public function edit($attributes, GetGiat $getGiat)
    {
        return $this->update($attributes, $getGiat);
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null|void
     */
    public function destroy(GetGiat $getGiat)
    {
        return $this->delete($getGiat);
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
            'id_giat',
            'tahun',
            'id_daerah',
        ];

        return $this->model->updateOrCreate(
            $attributes->only($fillable->only($keys))->toArray(),
            $attributes->only($fillable->except($keys))->toArray()
        );
    }*/

    public function getterKeys(): array
    {
        return [
            'id_giat',
            'tahun',
            'id_daerah',
        ];
    }
}
