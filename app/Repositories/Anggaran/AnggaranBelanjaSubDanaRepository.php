<?php

namespace App\Repositories\Anggaran;

use App\Models\Anggaran\AnggaranBelanjaSubDana;
use App\Repositories\Concerns\GetterUpdateOrCreate;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;

/**
 * \App\Repositories\Anggaran\AnggaranBelanjaSubDanaRepository
 *
 * @property AnggaranBelanjaSubDana $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|AnggaranBelanjaSubDana query()
 * @method \App\Models\Anggaran\AnggaranBelanjaSubDana update(array $attributes, AnggaranBelanjaSubDana $anggaranBelanjaSubDana)
 */
class AnggaranBelanjaSubDanaRepository extends Repository
{
    use GetterUpdateOrCreate;
    use WithExportQuery;
    use WithTable;

    /**
     * Create a new repository instance.
     */
    public function __construct(protected AnggaranBelanjaSubDana $model) {}

    public function getterKeys(): array
    {
        return [
            'id_dana_sub_bl',
            'tahun',
            'id_daerah',
            'id_jadwal',
        ];
    }

    /**
     * Create a new instance of the given model.
     *
     * @param  array  $attributes
     * @return AnggaranBelanjaSubDana
     */
    public function store($attributes)
    {
        return $this->create($attributes);
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return AnggaranBelanjaSubDana
     */
    public function edit($attributes, AnggaranBelanjaSubDana $anggaranBelanjaSubDana)
    {
        return $this->update($attributes, $anggaranBelanjaSubDana);
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null|void
     */
    public function destroy(AnggaranBelanjaSubDana $anggaranBelanjaSubDana)
    {
        return $this->delete($anggaranBelanjaSubDana);
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
