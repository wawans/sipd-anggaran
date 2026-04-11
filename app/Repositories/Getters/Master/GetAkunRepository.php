<?php

namespace App\Repositories\Getters\Master;

use App\Models\Getters\Master\GetAkun;
use App\Repositories\Concerns\GetterUpdateOrCreate;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * \App\Repositories\Getters\Master\GetAkunRepository
 *
 * @property GetAkun $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\Getters\Master\GetAkun query()
 * @method \App\Models\Getters\Master\GetAkun update(array $attributes, \App\Models\Getters\Master\GetAkun $getAkun)
 */
class GetAkunRepository extends Repository
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
    public function __construct(protected GetAkun $model) {}

    public function getterKeys(): array
    {
        return [
            'id_akun',
            'tahun',
            'id_daerah',
        ];
    }

    public function export(Collection|Request|array|null $request)
    {
        foreach ($this->model::cursor() as $item) {
            yield $item;
        }
    }

    /**
     * Create a new instance of the given model.
     *
     * @param  array  $attributes
     * @return GetAkun
     */
    public function store($attributes)
    {
        return $this->create($attributes);
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return GetAkun
     */
    public function edit($attributes, GetAkun $getAkun)
    {
        return $this->update($attributes, $getAkun);
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null|void
     */
    public function destroy(GetAkun $getAkun)
    {
        return $this->delete($getAkun);
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
}
