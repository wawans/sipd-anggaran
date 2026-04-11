<?php

namespace App\Repositories\Getters\Anggaran;

use App\Models\Getters\Anggaran\GetAnggaranBelanjaSubKet;
use App\Repositories\Concerns\GetterUpdateOrCreate;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;

/**
 * \App\Repositories\Getters\Anggaran\GetAnggaranBelanjaSubKetRepository
 *
 * @property GetAnggaranBelanjaSubKet $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|GetAnggaranBelanjaSubKet query()
 * @method GetAnggaranBelanjaSubKet update(array $attributes, GetAnggaranBelanjaSubKet $getAnggaranBelanjaSubKet)
 */
class GetAnggaranBelanjaSubKetRepository extends Repository
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
    public function __construct(protected GetAnggaranBelanjaSubKet $model) {}

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
     * @return GetAnggaranBelanjaSubKet
     */
    public function store($attributes)
    {
        return $this->create($attributes);
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return GetAnggaranBelanjaSubKet
     */
    public function edit($attributes, GetAnggaranBelanjaSubKet $getAnggaranBelanjaSubKet)
    {
        return $this->update($attributes, $getAnggaranBelanjaSubKet);
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null|void
     */
    public function destroy(GetAnggaranBelanjaSubKet $getAnggaranBelanjaSubKet)
    {
        return $this->delete($getAnggaranBelanjaSubKet);
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
