<?php

namespace App\Repositories\Getters\Anggaran;

use App\Models\Getters\Anggaran\GetAnggaranBelanjaSubSub;
use App\Repositories\Concerns\GetterUpdateOrCreate;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;

/**
 * \App\Repositories\Getters\Anggaran\GetAnggaranBelanjaSubSubRepository
 *
 * @property GetAnggaranBelanjaSubSub $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|GetAnggaranBelanjaSubSub query()
 * @method GetAnggaranBelanjaSubSub update(array $attributes, GetAnggaranBelanjaSubSub $getAnggaranBelanjaSubSub)
 */
class GetAnggaranBelanjaSubSubRepository extends Repository
{
    use GetterUpdateOrCreate;
    use WithExportQuery;
    use WithTable;

    /**
     * Create a new repository instance.
     */
    public function __construct(protected GetAnggaranBelanjaSubSub $model) {}

    public function getterKeys(): array
    {
        return [
            'id_subs_sub_bl',
            'tahun',
            'id_daerah',
        ];
    }

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
