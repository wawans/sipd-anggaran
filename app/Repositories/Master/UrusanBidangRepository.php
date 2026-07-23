<?php

namespace App\Repositories\Master;

use App\Models\Master\UrusanBidang;
use App\Repositories\Concerns\GetterUpdateOrCreate;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;

/**
 * \App\Repositories\Master\UrusanBidangRepository
 *
 * @property UrusanBidang $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\Master\UrusanBidang query()
 * @method \App\Models\Master\UrusanBidang update(array $attributes, \App\Models\Master\UrusanBidang $urusanBidang)
 */
class UrusanBidangRepository extends Repository
{
    use GetterUpdateOrCreate;
    use WithExportQuery;
    use WithTable;

    /**
     * Create a new repository instance.
     */
    public function __construct(protected UrusanBidang $model) {}

    /**
     * Create a new instance of the given model.
     *
     * @param  array  $attributes
     * @return UrusanBidang
     */
    public function store($attributes)
    {
        return $this->create($attributes);
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return UrusanBidang
     */
    public function edit($attributes, UrusanBidang $urusanBidang)
    {
        return $this->update($attributes, $urusanBidang);
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null|void
     */
    public function destroy(UrusanBidang $urusanBidang)
    {
        return $this->delete($urusanBidang);
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
