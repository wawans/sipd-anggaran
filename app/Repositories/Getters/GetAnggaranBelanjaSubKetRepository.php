<?php

namespace App\Repositories\Getters;

use App\Models\Getters\GetAnggaranBelanjaSubKet;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;

/**
 * \App\Repositories\Getters\GetAnggaranBelanjaSubKetRepository
 *
 * @property GetAnggaranBelanjaSubKet $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\Getters\GetAnggaranBelanjaSubKet query()
 * @method \App\Models\Getters\GetAnggaranBelanjaSubKet update(array $attributes, \App\Models\Getters\GetAnggaranBelanjaSubKet $getAnggaranBelanjaSubKet)
 */
class GetAnggaranBelanjaSubKetRepository extends Repository
{
    use WithExportQuery;
    use WithTable;

    /**
     * Create a new repository instance.
     */
    public function __construct(protected GetAnggaranBelanjaSubKet $model) {}

    /**
     * Create a new instance of the given model.
     *
     * @param  array  $attributes
     * @return GetAnggaranBelanjaSubKet
     */
    public function store($attributes)
    {
        return $this->create($attributes);
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return GetAnggaranBelanjaSubKet
     */
    public function edit($attributes, GetAnggaranBelanjaSubKet $getAnggaranBelanjaSubKet)
    {
        return $this->update($attributes, $getAnggaranBelanjaSubKet);
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null|void
     */
    public function destroy(GetAnggaranBelanjaSubKet $getAnggaranBelanjaSubKet)
    {
        return $this->delete($getAnggaranBelanjaSubKet);
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
