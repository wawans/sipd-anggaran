<?php

namespace App\Repositories\Getters;

use App\Models\Getters\GetAnggaranBelanjaSubRinci;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;

/**
 * \App\Repositories\Getters\GetAnggaranBelanjaSubRinciRepository
 *
 * @property GetAnggaranBelanjaSubRinci $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\Getters\GetAnggaranBelanjaSubRinci query()
 * @method \App\Models\Getters\GetAnggaranBelanjaSubRinci update(array $attributes, \App\Models\Getters\GetAnggaranBelanjaSubRinci $getAnggaranBelanjaSubRinci)
 */
class GetAnggaranBelanjaSubRinciRepository extends Repository
{
    use WithExportQuery;
    use WithTable;

    /**
     * Create a new repository instance.
     */
    public function __construct(protected GetAnggaranBelanjaSubRinci $model) {}

    /**
     * Create a new instance of the given model.
     *
     * @param  array  $attributes
     * @return GetAnggaranBelanjaSubRinci
     */
    public function store($attributes)
    {
        return $this->create($attributes);
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return GetAnggaranBelanjaSubRinci
     */
    public function edit($attributes, GetAnggaranBelanjaSubRinci $getAnggaranBelanjaSubRinci)
    {
        return $this->update($attributes, $getAnggaranBelanjaSubRinci);
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null|void
     */
    public function destroy(GetAnggaranBelanjaSubRinci $getAnggaranBelanjaSubRinci)
    {
        return $this->delete($getAnggaranBelanjaSubRinci);
    }

    /**
     * Delete the model(s) from the database.
     *
     * @return bool|null|void
     */
    public function destroys(array $keys)
    {
        return $this->query()->whereIn('id', $keys)->delete();
    }

    public function truncate()
    {
        return $this->query()->truncate();
    }
}
