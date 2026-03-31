<?php

namespace App\Repositories\Getters;

use App\Models\Getters\GetAnggaranBelanjaSubDana;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;

/**
 * \App\Repositories\Getters\GetAnggaranBelanjaSubDanaRepository
 *
 * @property GetAnggaranBelanjaSubDana $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\Getters\GetAnggaranBelanjaSubDana query()
 * @method \App\Models\Getters\GetAnggaranBelanjaSubDana update(array $attributes, \App\Models\Getters\GetAnggaranBelanjaSubDana $getAnggaranBelanjaSubDana)
 */
class GetAnggaranBelanjaSubDanaRepository extends Repository
{
    use WithExportQuery;
    use WithTable;

    /**
     * Create a new repository instance.
     */
    public function __construct(protected GetAnggaranBelanjaSubDana $model) {}

    /**
     * Create a new instance of the given model.
     *
     * @param  array  $attributes
     * @return GetAnggaranBelanjaSubDana
     */
    public function store($attributes)
    {
        return $this->create($attributes);
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return GetAnggaranBelanjaSubDana
     */
    public function edit($attributes, GetAnggaranBelanjaSubDana $getAnggaranBelanjaSubDana)
    {
        return $this->update($attributes, $getAnggaranBelanjaSubDana);
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null|void
     */
    public function destroy(GetAnggaranBelanjaSubDana $getAnggaranBelanjaSubDana)
    {
        return $this->delete($getAnggaranBelanjaSubDana);
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
