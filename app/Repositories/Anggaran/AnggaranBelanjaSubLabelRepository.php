<?php

namespace App\Repositories\Anggaran;

use App\Models\Anggaran\AnggaranBelanjaSubLabel;
use App\Repositories\Concerns\GetterUpdateOrCreate;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;

/**
 * \App\Repositories\Anggaran\AnggaranBelanjaSubLabelRepository
 *
 * @property AnggaranBelanjaSubLabel $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\Anggaran\AnggaranBelanjaSubLabel query()
 * @method \App\Models\Anggaran\AnggaranBelanjaSubLabel update(array $attributes, \App\Models\Anggaran\AnggaranBelanjaSubLabel $anggaranBelanjaSubLabel)
 */
class AnggaranBelanjaSubLabelRepository extends Repository
{
    use GetterUpdateOrCreate;
    use WithExportQuery;
    use WithTable;

    /**
     * Create a new repository instance.
     */
    public function __construct(protected AnggaranBelanjaSubLabel $model) {}

    public function getterKeys(): array
    {
        return [
            'id_label_bl',
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
     * @return AnggaranBelanjaSubLabel
     */
    public function store($attributes)
    {
        return $this->create($attributes);
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return AnggaranBelanjaSubLabel
     */
    public function edit($attributes, AnggaranBelanjaSubLabel $anggaranBelanjaSubLabel)
    {
        return $this->update($attributes, $anggaranBelanjaSubLabel);
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null|void
     */
    public function destroy(AnggaranBelanjaSubLabel $anggaranBelanjaSubLabel)
    {
        return $this->delete($anggaranBelanjaSubLabel);
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
