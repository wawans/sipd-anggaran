<?php

namespace App\Repositories\Getters\Anggaran;

use App\Models\Getters\Anggaran\GetAnggaranSkpd;
use App\Repositories\Concerns\GetterUpdateOrCreate;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;

/**
 * \App\Repositories\Getters\Anggaran\GetAnggaranSkpdRepository
 *
 * @property GetAnggaranSkpd $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|GetAnggaranSkpd query()
 * @method GetAnggaranSkpd update(array $attributes, GetAnggaranSkpd $getAnggaranSkpd)
 */
class GetAnggaranSkpdRepository extends Repository
{
    use GetterUpdateOrCreate;
    use WithExportQuery;
    use WithTable;

    /**
     * Create a new repository instance.
     */
    public function __construct(protected GetAnggaranSkpd $model) {}

    public function getterKeys(): array
    {
        return [
            'tahun',
            'id_daerah',
            'id_skpd',
            'id_unit',
        ];
    }

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
    public function edit($attributes, GetAnggaranSkpd|int $getAnggaranSkpd)
    {
        return $this->update($attributes, $getAnggaranSkpd);
    }

    /**
     * Bulk Update the model in the database.
     *
     * @param  array  $attributes
     * @param  list<GetAnggaranSkpd | int>  $ids
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
