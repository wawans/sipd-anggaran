<?php

namespace App\Repositories\Anggaran;

use App\Models\Anggaran\AnggaranBelanjaSubKet;
use App\Repositories\Concerns\GetterUpdateOrCreate;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;

/**
 * \App\Repositories\Anggaran\AnggaranBelanjaSubKetRepository
 *
 * @property AnggaranBelanjaSubKet $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|AnggaranBelanjaSubKet query()
 * @method AnggaranBelanjaSubKet update(array $attributes, AnggaranBelanjaSubKet $anggaranBelanjaSubKet)
 */
class AnggaranBelanjaSubKetRepository extends Repository
{
    use GetterUpdateOrCreate;
    use WithExportQuery;
    use WithTable;

    /**
     * Create a new repository instance.
     */
    public function __construct(protected AnggaranBelanjaSubKet $model) {}

    public function getterKeys(): array
    {
        return [
            'id_ket_sub_bl',
            'tahun',
            'id_daerah',
        ];
    }

    /**
     * Create a new instance of the given model.
     *
     * @param  array  $attributes
     * @return AnggaranBelanjaSubKet
     */
    public function store($attributes)
    {
        return $this->create($attributes);
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return AnggaranBelanjaSubKet
     */
    public function edit($attributes, AnggaranBelanjaSubKet $anggaranBelanjaSubKet)
    {
        return $this->update($attributes, $anggaranBelanjaSubKet);
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null|void
     */
    public function destroy(AnggaranBelanjaSubKet $anggaranBelanjaSubKet)
    {
        return $this->delete($anggaranBelanjaSubKet);
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
