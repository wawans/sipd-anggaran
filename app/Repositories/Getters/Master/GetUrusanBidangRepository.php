<?php

namespace App\Repositories\Getters\Master;

use App\Models\Getters\Master\GetUrusanBidang;
use App\Repositories\Concerns\GetterUpdateOrCreate;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;

/**
 * \App\Repositories\Getters\Master\GetUrusanBidangRepository
 *
 * @property GetUrusanBidang $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\Getters\Master\GetUrusanBidang query()
 * @method \App\Models\Getters\Master\GetUrusanBidang update(array $attributes, \App\Models\Getters\Master\GetUrusanBidang $getUrusanBidang)
 */
class GetUrusanBidangRepository extends Repository
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
    public function __construct(protected GetUrusanBidang $model) {}

    /**
     * Create a new instance of the given model.
     *
     * @param  array  $attributes
     * @return GetUrusanBidang
     */
    public function store($attributes)
    {
        return $this->create($attributes);
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return GetUrusanBidang
     */
    public function edit($attributes, GetUrusanBidang $getUrusanBidang)
    {
        return $this->update($attributes, $getUrusanBidang);
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null|void
     */
    public function destroy(GetUrusanBidang $getUrusanBidang)
    {
        return $this->delete($getUrusanBidang);
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
            'id_bidang_urusan',
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
            'id_bidang_urusan',
            'tahun',
            'id_daerah',
        ];
    }
}
