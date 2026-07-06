<?php

namespace App\Repositories\Getters\Master;

use App\Models\Getters\Master\LabelProv;
use App\Repositories\Concerns\GetterUpdateOrCreate;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;

/**
 * \App\Repositories\Getters\Master\LabelProvRepository
 *
 * @property LabelProv $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\Getters\Master\LabelProv query()
 * @method \App\Models\Getters\Master\LabelProv update(array $attributes, \App\Models\Getters\Master\LabelProv $labelProv)
 */
class LabelProvRepository extends Repository
{
    use GetterUpdateOrCreate;
    use WithExportQuery;
    use WithTable;

    /**
     * Create a new repository instance.
     */
    public function __construct(protected LabelProv $model) {}

    /**
     * Create a new instance of the given model.
     *
     * @param  array  $attributes
     * @return LabelProv
     */
    public function store($attributes)
    {
        return $this->create($attributes);
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return LabelProv
     */
    public function edit($attributes, LabelProv $labelProv)
    {
        return $this->update($attributes, $labelProv);
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null|void
     */
    public function destroy(LabelProv $labelProv)
    {
        return $this->delete($labelProv);
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
            'id_label_prov',
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
            'id_label_prov',
            'tahun',
            'id_daerah',
        ];
    }
}
