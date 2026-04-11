<?php

namespace App\Repositories\Getters\Anggaran;

use App\Models\Getters\Anggaran\GetAnggaranBelanjaSub;
use App\Repositories\Concerns\GetterUpdateOrCreate;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;

/**
 * \App\Repositories\Getters\Anggaran\GetAnggaranBelanjaSubRepository
 *
 * @property GetAnggaranBelanjaSub $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|GetAnggaranBelanjaSub query()
 * @method GetAnggaranBelanjaSub update(array $attributes, GetAnggaranBelanjaSub $getAnggaranBelanjaSub)
 */
class GetAnggaranBelanjaSubRepository extends Repository
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
    public function __construct(protected GetAnggaranBelanjaSub $model) {}

    public function getterKeys(): array
    {
        return [
            'id_sub_bl',
            'tahun',
            'id_daerah',
        ];
    }

    /**
     * Create a new instance of the given model.
     *
     * @param  array  $attributes
     * @return GetAnggaranBelanjaSub
     */
    public function store($attributes)
    {
        return $this->create($attributes);
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return GetAnggaranBelanjaSub
     */
    public function edit($attributes, GetAnggaranBelanjaSub|int $getAnggaranBelanjaSub)
    {
        return $this->update($attributes, $getAnggaranBelanjaSub);
    }

    /**
     * Bulk Update the model in the database.
     *
     * @param  array  $attributes
     * @param  list<GetAnggaranBelanjaSub | int>  $ids
     * @return void
     */
    public function edits($attributes, array $ids)
    {
        return $this->query()->whereIn('id', $ids)->update($attributes);
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null|void
     */
    public function destroy(GetAnggaranBelanjaSub $getAnggaranBelanjaSub)
    {
        return $this->delete($getAnggaranBelanjaSub);
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
