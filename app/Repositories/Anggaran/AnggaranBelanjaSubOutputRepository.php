<?php

namespace App\Repositories\Anggaran;

use App\Models\Anggaran\AnggaranBelanjaSubOutput;
use App\Repositories\Concerns\GetterUpdateOrCreate;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;

/**
 * \App\Repositories\Anggaran\AnggaranBelanjaSubOutputRepository
 *
 * @property AnggaranBelanjaSubOutput $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\Anggaran\AnggaranBelanjaSubOutput query()
 * @method \App\Models\Anggaran\AnggaranBelanjaSubOutput update(array $attributes, \App\Models\Anggaran\AnggaranBelanjaSubOutput $anggaranBelanjaSubOutput)
 */
class AnggaranBelanjaSubOutputRepository extends Repository
{
    use GetterUpdateOrCreate;
    use WithExportQuery;
    use WithTable;

    /**
     * Create a new repository instance.
     */
    public function __construct(protected AnggaranBelanjaSubOutput $model) {}

    public function getterKeys(): array
    {
        return [
            'id_output_bl',
            'tahun',
            'id_daerah',
            'id_jadwal',
            'id_unit',
            'id_bl',
            'id_sub_bl',
        ];
    }

    /**
     * Create a new instance of the given model.
     *
     * @param  array  $attributes
     * @return AnggaranBelanjaSubOutput
     */
    public function store($attributes)
    {
        return $this->create($attributes);
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return AnggaranBelanjaSubOutput
     */
    public function edit($attributes, AnggaranBelanjaSubOutput $anggaranBelanjaSubOutput)
    {
        return $this->update($attributes, $anggaranBelanjaSubOutput);
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null|void
     */
    public function destroy(AnggaranBelanjaSubOutput $anggaranBelanjaSubOutput)
    {
        return $this->delete($anggaranBelanjaSubOutput);
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

    public function truncate()
    {
        return $this->query()->truncate();
    }
}
