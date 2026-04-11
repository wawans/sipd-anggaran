<?php

namespace App\Repositories\Getters\Anggaran;

use App\Models\Getters\Anggaran\GetAnggaranBelanjaSubOutput;
use App\Repositories\Concerns\GetterUpdateOrCreate;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;

/**
 * \App\Repositories\Getters\Anggaran\GetAnggaranBelanjaSubOutputRepository
 *
 * @property GetAnggaranBelanjaSubOutput $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\Getters\Anggaran\GetAnggaranBelanjaSubOutput query()
 * @method \App\Models\Getters\Anggaran\GetAnggaranBelanjaSubOutput update(array $attributes, \App\Models\Getters\Anggaran\GetAnggaranBelanjaSubOutput $getAnggaranBelanjaSubOutput)
 */
class GetAnggaranBelanjaSubOutputRepository extends Repository
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
    public function __construct(protected GetAnggaranBelanjaSubOutput $model) {}

    public function getterKeys(): array
    {
        return [
            'id_output_bl',
            'tahun',
            'id_daerah',
            'id_unit',
            'id_bl',
            'id_sub_bl',
        ];
    }

    /**
     * Create a new instance of the given model.
     *
     * @param  array  $attributes
     * @return GetAnggaranBelanjaSubOutput
     */
    public function store($attributes)
    {
        return $this->create($attributes);
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return GetAnggaranBelanjaSubOutput
     */
    public function edit($attributes, GetAnggaranBelanjaSubOutput $getAnggaranBelanjaSubOutput)
    {
        return $this->update($attributes, $getAnggaranBelanjaSubOutput);
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null|void
     */
    public function destroy(GetAnggaranBelanjaSubOutput $getAnggaranBelanjaSubOutput)
    {
        return $this->delete($getAnggaranBelanjaSubOutput);
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
