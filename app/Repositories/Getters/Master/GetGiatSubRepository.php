<?php

namespace App\Repositories\Getters\Master;

use App\Models\Getters\Master\GetGiatSub;
use App\Repositories\Concerns\GetterUpdateOrCreate;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;

/**
 * \App\Repositories\Getters\Master\GetGiatSubRepository
 *
 * @property GetGiatSub $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\Getters\Master\GetGiatSub query()
 * @method \App\Models\Getters\Master\GetGiatSub update(array $attributes, \App\Models\Getters\Master\GetGiatSub $getGiatSub)
 */
class GetGiatSubRepository extends Repository
{
    use GetterUpdateOrCreate;
    use WithExportQuery;
    use WithTable;

    /**
     * Export using generator.
     */
    public bool $withGenerator = true;

    /**
     * Create a new repository instance.
     */
    public function __construct(protected GetGiatSub $model) {}

    /**
     * Create a new instance of the given model.
     *
     * @param  array  $attributes
     * @return GetGiatSub
     */
    public function store($attributes)
    {
        return $this->create($attributes);
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return GetGiatSub
     */
    public function edit($attributes, GetGiatSub $getGiatSub)
    {
        return $this->update($attributes, $getGiatSub);
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null|void
     */
    public function destroy(GetGiatSub $getGiatSub)
    {
        return $this->delete($getGiatSub);
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
            'id_sub_giat',
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
            'id_sub_giat',
            'tahun',
            'id_daerah',
        ];
    }
}
