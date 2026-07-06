<?php

namespace App\Repositories\Getters\Master;

use App\Models\Getters\Master\Program;
use App\Repositories\Concerns\GetterUpdateOrCreate;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;

/**
 * \App\Repositories\Getters\Master\ProgramRepository
 *
 * @property Program $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\Getters\Master\Program query()
 * @method \App\Models\Getters\Master\Program update(array $attributes, \App\Models\Getters\Master\Program $program)
 */
class ProgramRepository extends Repository
{
    use GetterUpdateOrCreate;
    use WithExportQuery;
    use WithTable;

    /**
     * Create a new repository instance.
     */
    public function __construct(protected Program $model) {}

    /**
     * Create a new instance of the given model.
     *
     * @param  array  $attributes
     * @return Program
     */
    public function store($attributes)
    {
        return $this->create($attributes);
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return Program
     */
    public function edit($attributes, Program $program)
    {
        return $this->update($attributes, $program);
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null|void
     */
    public function destroy(Program $program)
    {
        return $this->delete($program);
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
            'id_program',
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
            'id_program',
            'tahun',
            'id_daerah',
        ];
    }
}
