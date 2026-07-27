<?php

namespace App\Repositories\Master;

use App\Models\Master\Tahap;
use App\Repositories\Concerns\GetterUpdateOrCreate;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;

/**
 * \App\Repositories\Master\TahapRepository
 *
 * @property Tahap $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\Master\Tahap query()
 * @method \App\Models\Master\Tahap update(array $attributes, \App\Models\Master\Tahap $tahap)
 */
class TahapRepository extends Repository
{
    use GetterUpdateOrCreate;
    use WithExportQuery;
    use WithTable;

    /**
     * Create a new repository instance.
     */
    public function __construct(protected Tahap $model) {}

    /**
     * Create a new instance of the given model.
     *
     * @param  array  $attributes
     * @return Tahap
     */
    public function store($attributes)
    {
        return $this->create($attributes);
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return Tahap
     */
    public function edit($attributes, Tahap $tahap)
    {
        return $this->update($attributes, $tahap);
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null|void
     */
    public function destroy(Tahap $tahap)
    {
        return $this->delete($tahap);
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

    public function getterKeys(): array
    {
        return [
            'id_tahap',
        ];
    }
}
