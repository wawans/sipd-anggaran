<?php

namespace App\Repositories\Getters\Master;

use App\Models\Getters\Master\Akun;
use App\Repositories\Concerns\GetterUpdateOrCreate;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * \App\Repositories\Getters\Master\AkunRepository
 *
 * @property Akun $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|\App\Models\Getters\Master\Akun query()
 * @method \App\Models\Getters\Master\Akun update(array $attributes, \App\Models\Getters\Master\Akun $akun)
 */
class AkunRepository extends Repository
{
    use GetterUpdateOrCreate;
    use WithExportQuery;
    use WithTable;

    /**
     * Create a new repository instance.
     */
    public function __construct(protected Akun $model) {}

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
     * @return Akun
     */
    public function store($attributes)
    {
        return $this->create($attributes);
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return Akun
     */
    public function edit($attributes, Akun $akun)
    {
        return $this->update($attributes, $akun);
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null|void
     */
    public function destroy(Akun $akun)
    {
        return $this->delete($akun);
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
