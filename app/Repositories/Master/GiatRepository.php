<?php

namespace App\Repositories\Master;

use App\Models\Master\Giat;
use App\Repositories\Concerns\GetterUpdateOrCreate;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;

/**
 * \App\Repositories\Master\GiatRepository
 *
 * @property Giat $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\Master\Giat query()
 * @method \App\Models\Master\Giat update(array $attributes, \App\Models\Master\Giat $giat)
 */
class GiatRepository extends Repository
{
    use GetterUpdateOrCreate;
    use WithExportQuery;
    use WithTable;

    /**
     * Create a new repository instance.
     */
    public function __construct(protected Giat $model) {}

    /**
     * Create a new instance of the given model.
     *
     * @param  array  $attributes
     * @return Giat
     */
    public function store($attributes)
    {
        return $this->create($attributes);
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return Giat
     */
    public function edit($attributes, Giat $giat)
    {
        return $this->update($attributes, $giat);
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null|void
     */
    public function destroy(Giat $giat)
    {
        return $this->delete($giat);
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
