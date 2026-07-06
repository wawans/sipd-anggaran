<?php

namespace App\Repositories\Getters\Master;

use App\Models\Getters\Master\Daerah;
use App\Repositories\Concerns\GetterUpdateOrCreate;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;

/**
 * \App\Repositories\Getters\Master\DaerahRepository
 *
 * @property Daerah $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\Getters\Master\Daerah query()
 * @method \App\Models\Getters\Master\Daerah update(array $attributes, \App\Models\Getters\Master\Daerah $daerah)
 */
class DaerahRepository extends Repository
{
    use GetterUpdateOrCreate;
    use WithExportQuery;
    use WithTable;

    /**
     * Create a new repository instance.
     */
    public function __construct(protected Daerah $model) {}

    public function getterKeys(): array
    {
        return [
            'id_daerah',
        ];
    }

    /**
     * Create a new instance of the given model.
     *
     * @param  array  $attributes
     * @return Daerah
     */
    public function store($attributes)
    {
        return $this->create($attributes);
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return Daerah
     */
    public function edit($attributes, Daerah $daerah)
    {
        return $this->update($attributes, $daerah);
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null|void
     */
    public function destroy(Daerah $daerah)
    {
        return $this->delete($daerah);
    }

    /**
     * Delete the model(s) from the database.
     *
     * @param  list<int>  $keys
     * @return bool|null|void
     */
    public function destroys(array $keys)
    {
        return $this->query()->whereIn('id', $keys)->delete();
    }
}
