<?php

namespace App\Repositories\Master;

use App\Models\Master\GiatSub;
use App\Repositories\Concerns\GetterUpdateOrCreate;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;

/**
 * \App\Repositories\Master\GiatSubRepository
 *
 * @property GiatSub $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\Master\GiatSub query()
 * @method \App\Models\Master\GiatSub update(array $attributes, \App\Models\Master\GiatSub $giatSub)
 */
class GiatSubRepository extends Repository
{
    use GetterUpdateOrCreate;
    use WithExportQuery;
    use WithTable;

    /**
     * Create a new repository instance.
     */
    public function __construct(protected GiatSub $model) {}

    /**
     * Create a new instance of the given model.
     *
     * @param  array  $attributes
     * @return GiatSub
     */
    public function store($attributes)
    {
        return $this->create($attributes);
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return GiatSub
     */
    public function edit($attributes, GiatSub $giatSub)
    {
        return $this->update($attributes, $giatSub);
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null|void
     */
    public function destroy(GiatSub $giatSub)
    {
        return $this->delete($giatSub);
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
