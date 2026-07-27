<?php

namespace App\Repositories\Master;

use App\Models\Master\Jadwal;
use App\Repositories\Concerns\GetterUpdateOrCreate;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;

/**
 * \App\Repositories\Master\JadwalRepository
 *
 * @property Jadwal $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\Master\Jadwal query()
 * @method \App\Models\Master\Jadwal update(array $attributes, \App\Models\Master\Jadwal $jadwal)
 */
class JadwalRepository extends Repository
{
    use GetterUpdateOrCreate;
    use WithExportQuery;
    use WithTable;

    /**
     * Create a new repository instance.
     */
    public function __construct(protected Jadwal $model) {}

    /**
     * Create a new instance of the given model.
     *
     * @param  array  $attributes
     * @return Jadwal
     */
    public function store($attributes)
    {
        return $this->create($attributes);
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return Jadwal
     */
    public function edit($attributes, Jadwal $jadwal)
    {
        return $this->update($attributes, $jadwal);
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null|void
     */
    public function destroy(Jadwal $jadwal)
    {
        return $this->delete($jadwal);
    }

    /**
     * Delete the model(s) from the database.
     *
     * @param  list<string>  $keys
     * @return bool|null|void
     */
    public function destroys(array $keys)
    {
        return $this->query()->whereIn('id', $keys)->delete();
    }

    public function getterKeys(): array
    {
        return [
            'id_jadwal',
            'tahun',
            'id_daerah',
            'id_tahap',
        ];
    }
}
