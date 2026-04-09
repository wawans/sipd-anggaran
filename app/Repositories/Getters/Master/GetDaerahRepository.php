<?php

namespace App\Repositories\Getters\Master;

use App\Models\Getters\GetDaerah;
use App\Repositories\Concerns\GetterUpdateOrCreate;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;

/**
 * \App\Repositories\Getters\Master\GetDaerahRepository
 *
 * @property GetDaerah $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\Getters\GetDaerah query()
 * @method \App\Models\Getters\GetDaerah update(array $attributes, \App\Models\Getters\GetDaerah $getDaerah)
 */
class GetDaerahRepository extends Repository
{
    use GetterUpdateOrCreate;
    use WithExportQuery;
    use WithTable;

    /**
     * Create a new repository instance.
     */
    public function __construct(protected GetDaerah $model) {}

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
     * @return GetDaerah
     */
    public function store($attributes)
    {
        return $this->create($attributes);
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return GetDaerah
     */
    public function edit($attributes, GetDaerah $getDaerah)
    {
        return $this->update($attributes, $getDaerah);
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null|void
     */
    public function destroy(GetDaerah $getDaerah)
    {
        return $this->delete($getDaerah);
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
