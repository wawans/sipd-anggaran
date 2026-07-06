<?php

namespace App\Repositories\Getters\Master;

use App\Models\Getters\Master\LabelKokab;
use App\Repositories\Concerns\GetterUpdateOrCreate;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;

/**
 * \App\Repositories\Getters\Master\LabelKokabRepository
 *
 * @property LabelKokab $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\Getters\Master\LabelKokab query()
 * @method \App\Models\Getters\Master\LabelKokab update(array $attributes, \App\Models\Getters\Master\LabelKokab $labelKokab)
 */
class LabelKokabRepository extends Repository
{
    use GetterUpdateOrCreate;
    use WithExportQuery;
    use WithTable;

    /**
     * Create a new repository instance.
     */
    public function __construct(protected LabelKokab $model) {}

    /**
     * Create a new instance of the given model.
     *
     * @param  array  $attributes
     * @return LabelKokab
     */
    public function store($attributes)
    {
        return $this->create($attributes);
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return LabelKokab
     */
    public function edit($attributes, LabelKokab $labelKokab)
    {
        return $this->update($attributes, $labelKokab);
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null|void
     */
    public function destroy(LabelKokab $labelKokab)
    {
        return $this->delete($labelKokab);
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
            'id_label_kokab',
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
            'id_label_kokab',
            'tahun',
            'id_daerah',
        ];
    }
}
