<?php

namespace App\Repositories\Getters\Master;

use App\Models\Getters\Master\GetSkpd;
use App\Repositories\Concerns\GetterUpdateOrCreate;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;

/**
 * \App\Repositories\Getters\Master\GetSkpdRepository
 *
 * @property GetSkpd $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\Getters\Master\GetSkpd query()
 * @method \App\Models\Getters\Master\GetSkpd update(array $attributes, \App\Models\Getters\Master\GetSkpd $getSkpd)
 */
class GetSkpdRepository extends Repository
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
    public function __construct(protected GetSkpd $model) {}

    /**
     * Create a new instance of the given model.
     *
     * @param  array  $attributes
     * @return GetSkpd
     */
    public function store($attributes)
    {
        return $this->create($attributes);
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return GetSkpd
     */
    public function edit($attributes, GetSkpd $getSkpd)
    {
        return $this->update($attributes, $getSkpd);
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null|void
     */
    public function destroy(GetSkpd $getSkpd)
    {
        return $this->delete($getSkpd);
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
