<?php

namespace App\Repositories\Master;

use App\Models\Getters\Master\LabelPusat;
use App\Repositories\Concerns\GetterUpdateOrCreate;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;

/**
 * \App\Repositories\Master\LabelPusatRepository
 *
 * @property LabelPusat $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\Getters\Master\LabelPusat query()
 * @method \App\Models\Getters\Master\LabelPusat update(array $attributes, \App\Models\Getters\Master\LabelPusat $labelPusat)
 */
class LabelPusatRepository extends Repository
{
    use GetterUpdateOrCreate;
    use WithExportQuery;
    use WithTable;

    /**
     * Create a new repository instance.
     */
    public function __construct(protected LabelPusat $model) {}

    /**
     * Create a new instance of the given model.
     *
     * @param  array  $attributes
     * @return LabelPusat
     */
    public function store($attributes)
    {
        return $this->create($attributes);
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return LabelPusat
     */
    public function edit($attributes, LabelPusat $labelPusat)
    {
        return $this->update($attributes, $labelPusat);
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null|void
     */
    public function destroy(LabelPusat $labelPusat)
    {
        return $this->delete($labelPusat);
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
