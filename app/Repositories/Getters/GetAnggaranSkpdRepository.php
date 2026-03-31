<?php

namespace App\Repositories\Getters;

use App\Models\Getters\GetAnggaranSkpd;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;

/**
 * \App\Repositories\Getters\GetAnggaranSkpdRepository
 *
 * @property GetAnggaranSkpd $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\Getters\GetAnggaranSkpd query()
 * @method \App\Models\Getters\GetAnggaranSkpd update(array $attributes, \App\Models\Getters\GetAnggaranSkpd $getAnggaranSkpd)
 */
class GetAnggaranSkpdRepository extends Repository
{
    use WithExportQuery;
    use WithTable;

    /**
     * Create a new repository instance.
     */
    public function __construct(protected GetAnggaranSkpd $model) {}

    /**
     * Create a new instance of the given model.
     *
     * @param  array  $attributes
     * @return GetAnggaranSkpd
     */
    public function store($attributes)
    {
        return $this->create($attributes);
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return GetAnggaranSkpd
     */
    public function edit($attributes, GetAnggaranSkpd $getAnggaranSkpd)
    {
        return $this->update($attributes, $getAnggaranSkpd);
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null|void
     */
    public function destroy(GetAnggaranSkpd $getAnggaranSkpd)
    {
        return $this->delete($getAnggaranSkpd);
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
}
