<?php

namespace App\Repositories\Getters\Master;

use App\Models\Getters\Master\GetProgram;
use App\Repositories\Concerns\GetterUpdateOrCreate;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;

/**
 * \App\Repositories\Getters\Master\GetProgramRepository
 *
 * @property GetProgram $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\Getters\Master\GetProgram query()
 * @method \App\Models\Getters\Master\GetProgram update(array $attributes, \App\Models\Getters\Master\GetProgram $getProgram)
 */
class GetProgramRepository extends Repository
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
    public function __construct(protected GetProgram $model) {}

    /**
     * Create a new instance of the given model.
     *
     * @param  array  $attributes
     * @return GetProgram
     */
    public function store($attributes)
    {
        return $this->create($attributes);
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return GetProgram
     */
    public function edit($attributes, GetProgram $getProgram)
    {
        return $this->update($attributes, $getProgram);
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null|void
     */
    public function destroy(GetProgram $getProgram)
    {
        return $this->delete($getProgram);
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
