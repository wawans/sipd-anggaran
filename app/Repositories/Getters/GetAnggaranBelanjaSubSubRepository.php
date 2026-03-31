<?php

namespace App\Repositories\Getters;

use App\Models\Getters\GetAnggaranBelanjaSubSub;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;

/**
 * \App\Repositories\Getters\GetAnggaranBelanjaSubSubRepository
 *
 * @property GetAnggaranBelanjaSubSub $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\Getters\GetAnggaranBelanjaSubSub query()
 * @method \App\Models\Getters\GetAnggaranBelanjaSubSub update(array $attributes, \App\Models\Getters\GetAnggaranBelanjaSubSub $getAnggaranBelanjaSubSub)
 */
class GetAnggaranBelanjaSubSubRepository extends Repository
{
    use WithExportQuery;
    use WithTable;

    /**
     * Create a new repository instance.
     */
    public function __construct(protected GetAnggaranBelanjaSubSub $model) {}

    /**
     * Create a new instance of the given model.
     *
     * @param  array  $attributes
     * @return GetAnggaranBelanjaSubSub
     */
    public function store($attributes)
    {
        return $this->create($attributes);
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return GetAnggaranBelanjaSubSub
     */
    public function edit($attributes, GetAnggaranBelanjaSubSub $getAnggaranBelanjaSubSub)
    {
        return $this->update($attributes, $getAnggaranBelanjaSubSub);
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null|void
     */
    public function destroy(GetAnggaranBelanjaSubSub $getAnggaranBelanjaSubSub)
    {
        return $this->delete($getAnggaranBelanjaSubSub);
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
