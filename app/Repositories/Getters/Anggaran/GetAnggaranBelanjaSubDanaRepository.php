<?php

namespace App\Repositories\Getters\Anggaran;

use App\Models\Getters\Anggaran\GetAnggaranBelanjaSubDana;
use App\Repositories\Concerns\GetterUpdateOrCreate;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;

/**
 * \App\Repositories\Getters\Anggaran\GetAnggaranBelanjaSubDanaRepository
 *
 * @property GetAnggaranBelanjaSubDana $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|GetAnggaranBelanjaSubDana query()
 * @method GetAnggaranBelanjaSubDana update(array $attributes, GetAnggaranBelanjaSubDana $getAnggaranBelanjaSubDana)
 */
class GetAnggaranBelanjaSubDanaRepository extends Repository
{
    use GetterUpdateOrCreate;
    use WithExportQuery;
    use WithTable;

    /**
     * Export using generator.
     */
    public bool $withGenerator = true;

    /**
     * Create a new repository instance.
     */
    public function __construct(protected GetAnggaranBelanjaSubDana $model) {}

    public function getterKeys(): array
    {
        return [
            'id_dana_sub_bl',
            'tahun',
            'id_daerah',
        ];
    }

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
