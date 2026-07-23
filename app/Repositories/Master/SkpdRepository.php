<?php

namespace App\Repositories\Master;

use App\Models\Master\Skpd;
use App\Repositories\Concerns\GetterUpdateOrCreate;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;

/**
 * \App\Repositories\Master\SkpdRepository
 *
 * @property Skpd $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\Master\Skpd query()
 * @method \App\Models\Master\Skpd update(array $attributes, \App\Models\Master\Skpd $skpd)
 */
class SkpdRepository extends Repository
{
    use GetterUpdateOrCreate;
    use WithExportQuery;
    use WithTable;

    /**
     * Create a new repository instance.
     */
    public function __construct(protected Skpd $model) {}

    /**
     * Create a new instance of the given model.
     *
     * @param  array  $attributes
     * @return Skpd
     */
    public function store($attributes)
    {
        return $this->create($attributes);
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return Skpd
     */
    public function edit($attributes, Skpd $skpd)
    {
        return $this->update($attributes, $skpd);
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null|void
     */
    public function destroy(Skpd $skpd)
    {
        return $this->delete($skpd);
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

    /*public function updateOrCreate(array $data)
    {
        $attributes = collect($data);
        $fillable = collect($this->model->getFillable());
        $keys = [
            'id_skpd',
            'tahun',
            'id_daerah',
        ];

        return $this->model->updateOrCreate(
            $attributes->only($fillable->only($keys))->toArray(),
            $attributes->only($fillable->except($keys))->toArray()
        );
    }*/

    public function getterKeys(): array
    {
        return [
            'id_skpd',
            'tahun',
            'id_daerah',
        ];
    }
}
