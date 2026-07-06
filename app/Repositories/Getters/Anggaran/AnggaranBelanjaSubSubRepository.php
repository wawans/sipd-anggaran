<?php

namespace App\Repositories\Getters\Anggaran;

use App\Models\Getters\Anggaran\AnggaranBelanjaSubSub;
use App\Repositories\Concerns\GetterUpdateOrCreate;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;

/**
 * \App\Repositories\Getters\Anggaran\AnggaranBelanjaSubSubRepository
 *
 * @property AnggaranBelanjaSubSub $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|AnggaranBelanjaSubSub query()
 * @method AnggaranBelanjaSubSub update(array $attributes, AnggaranBelanjaSubSub $anggaranBelanjaSubSub)
 */
class AnggaranBelanjaSubSubRepository extends Repository
{
    use GetterUpdateOrCreate;
    use WithExportQuery;
    use WithTable;

    /**
     * Create a new repository instance.
     */
    public function __construct(protected AnggaranBelanjaSubSub $model) {}

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
     * @return AnggaranBelanjaSubSub
     */
    public function store($attributes)
    {
        return $this->create($attributes);
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return AnggaranBelanjaSubSub
     */
    public function edit($attributes, AnggaranBelanjaSubSub $anggaranBelanjaSubSub)
    {
        return $this->update($attributes, $anggaranBelanjaSubSub);
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null|void
     */
    public function destroy(AnggaranBelanjaSubSub $anggaranBelanjaSubSub)
    {
        return $this->delete($anggaranBelanjaSubSub);
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
