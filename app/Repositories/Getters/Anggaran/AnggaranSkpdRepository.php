<?php

namespace App\Repositories\Getters\Anggaran;

use App\Models\Getters\Anggaran\AnggaranSkpd;
use App\Repositories\Concerns\GetterUpdateOrCreate;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;

/**
 * \App\Repositories\Getters\Anggaran\AnggaranSkpdRepository
 *
 * @property AnggaranSkpd $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|AnggaranSkpd query()
 * @method AnggaranSkpd update(array $attributes, AnggaranSkpd $anggaranSkpd)
 */
class AnggaranSkpdRepository extends Repository
{
    use GetterUpdateOrCreate;
    use WithExportQuery;
    use WithTable;

    /**
     * Create a new repository instance.
     */
    public function __construct(protected AnggaranSkpd $model) {}

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
     * @return AnggaranSkpd
     */
    public function store($attributes)
    {
        return $this->create($attributes);
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return AnggaranSkpd
     */
    public function edit($attributes, AnggaranSkpd|int $anggaranSkpd)
    {
        return $this->update($attributes, $anggaranSkpd);
    }

    /**
     * Bulk Update the model in the database.
     *
     * @param  array  $attributes
     * @param  list<AnggaranSkpd | int>  $ids
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
    public function destroy(AnggaranSkpd $anggaranSkpd)
    {
        return $this->delete($anggaranSkpd);
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
