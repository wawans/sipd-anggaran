<?php

namespace App\Repositories\Getters\Anggaran;

use App\Models\Getters\Anggaran\GetAnggaranBelanjaSubLabel;
use App\Repositories\Concerns\GetterUpdateOrCreate;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;

/**
 * \App\Repositories\Getters\Anggaran\GetAnggaranBelanjaSubLabelRepository
 *
 * @property GetAnggaranBelanjaSubLabel $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\Getters\Anggaran\GetAnggaranBelanjaSubLabel query()
 * @method \App\Models\Getters\Anggaran\GetAnggaranBelanjaSubLabel update(array $attributes, \App\Models\Getters\Anggaran\GetAnggaranBelanjaSubLabel $getAnggaranBelanjaSubLabel)
 */
class GetAnggaranBelanjaSubLabelRepository extends Repository
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
    public function __construct(protected GetAnggaranBelanjaSubLabel $model) {}

    public function getterKeys(): array
    {
        return [
            'id_label_bl',
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
     * @return GetAnggaranBelanjaSubLabel
     */
    public function store($attributes)
    {
        return $this->create($attributes);
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return GetAnggaranBelanjaSubLabel
     */
    public function edit($attributes, GetAnggaranBelanjaSubLabel $getAnggaranBelanjaSubLabel)
    {
        return $this->update($attributes, $getAnggaranBelanjaSubLabel);
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null|void
     */
    public function destroy(GetAnggaranBelanjaSubLabel $getAnggaranBelanjaSubLabel)
    {
        return $this->delete($getAnggaranBelanjaSubLabel);
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
