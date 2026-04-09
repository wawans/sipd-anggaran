<?php

namespace App\Repositories\Getters\Master;

use App\Models\Getters\GetLabelPusat;
use App\Repositories\Concerns\GetterUpdateOrCreate;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;

/**
 * \App\Repositories\Getters\Master\GetLabelPusatRepository
 *
 * @property GetLabelPusat $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\Getters\GetLabelPusat query()
 * @method \App\Models\Getters\GetLabelPusat update(array $attributes, \App\Models\Getters\GetLabelPusat $getLabelPusat)
 */
class GetLabelPusatRepository extends Repository
{
    use GetterUpdateOrCreate;
    use WithExportQuery;
    use WithTable;

    /**
     * Create a new repository instance.
     */
    public function __construct(protected GetLabelPusat $model) {}

    /**
     * Create a new instance of the given model.
     *
     * @param  array  $attributes
     * @return GetLabelPusat
     */
    public function store($attributes)
    {
        return $this->create($attributes);
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return GetLabelPusat
     */
    public function edit($attributes, GetLabelPusat $getLabelPusat)
    {
        return $this->update($attributes, $getLabelPusat);
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null|void
     */
    public function destroy(GetLabelPusat $getLabelPusat)
    {
        return $this->delete($getLabelPusat);
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
            'id_label_pusat',
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
            'id_label_pusat',
            'tahun',
            'id_daerah',
        ];
    }
}
