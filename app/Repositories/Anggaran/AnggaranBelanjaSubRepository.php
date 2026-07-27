<?php

namespace App\Repositories\Anggaran;

use App\Models\Anggaran\AnggaranBelanjaSub;
use App\Repositories\Concerns\GetterUpdateOrCreate;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;

/**
 * \App\Repositories\Anggaran\AnggaranBelanjaSubRepository
 *
 * @property AnggaranBelanjaSub $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|AnggaranBelanjaSub query()
 * @method AnggaranBelanjaSub update(array $attributes, AnggaranBelanjaSub $anggaranBelanjaSub)
 */
class AnggaranBelanjaSubRepository extends Repository
{
    use GetterUpdateOrCreate;
    use WithExportQuery;
    use WithTable;

    /**
     * Create a new repository instance.
     */
    public function __construct(protected AnggaranBelanjaSub $model) {}

    public function getterKeys(): array
    {
        return [
            'id_sub_bl',
            'tahun',
            'id_daerah',
            'id_jadwal',
        ];
    }

    /**
     * Create a new instance of the given model.
     *
     * @param  array  $attributes
     * @return AnggaranBelanjaSub
     */
    public function store($attributes)
    {
        return $this->create($attributes);
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return AnggaranBelanjaSub
     */
    public function edit($attributes, AnggaranBelanjaSub|int $anggaranBelanjaSub)
    {
        return $this->update($attributes, $anggaranBelanjaSub);
    }

    /**
     * Bulk Update the model in the database.
     *
     * @param  array  $attributes
     * @param  list<AnggaranBelanjaSub | int>  $ids
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
    public function destroy(AnggaranBelanjaSub $anggaranBelanjaSub)
    {
        return $this->delete($anggaranBelanjaSub);
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
