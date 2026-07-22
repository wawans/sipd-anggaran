<?php

namespace App\Repositories\Master;

use App\Models\Master\SkpdSub;
use App\Repositories\Concerns\GetterUpdateOrCreate;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;

/**
 * \App\Repositories\Master\SkpdSubRepository
 *
 * @property SkpdSub $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\Master\SkpdSub query()
 * @method \App\Models\Master\SkpdSub update(array $attributes, \App\Models\Master\SkpdSub $skpdSub)
 */
class SkpdSubRepository extends Repository
{
    use GetterUpdateOrCreate;
    use WithExportQuery;
    use WithTable;

    /**
     * Create a new repository instance.
     */
    public function __construct(protected SkpdSub $model) {}

    /**
     * Create a new instance of the given model.
     *
     * @param  array  $attributes
     * @return SkpdSub
     */
    public function store($attributes)
    {
        return $this->create($attributes);
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return SkpdSub
     */
    public function edit($attributes, SkpdSub $skpdSub)
    {
        return $this->update($attributes, $skpdSub);
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null|void
     */
    public function destroy(SkpdSub $skpdSub)
    {
        return $this->delete($skpdSub);
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
            'id_sub_skpd',
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
            'id_sub_skpd',
            'tahun',
            'id_daerah',
        ];
    }
}
