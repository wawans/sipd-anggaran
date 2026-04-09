<?php

namespace App\Repositories\Getters\Anggaran;

use App\Models\Getters\Anggaran\GetAnggaranBelanjaSubRinci;
use App\Repositories\Concerns\GetterUpdateOrCreate;
use App\Repositories\Concerns\WithExportQuery;
use App\Repositories\Concerns\WithTable;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Cache;

/**
 * \App\Repositories\Getters\Anggaran\GetAnggaranBelanjaSubRinciRepository
 *
 * @property GetAnggaranBelanjaSubRinci $model
 *
 * @method \Illuminate\Database\Eloquent\Builder|GetAnggaranBelanjaSubRinci query()
 * @method GetAnggaranBelanjaSubRinci update(array $attributes, GetAnggaranBelanjaSubRinci $getAnggaranBelanjaSubRinci)
 */
class GetAnggaranBelanjaSubRinciRepository extends Repository
{
    use GetterUpdateOrCreate;
    use WithExportQuery;
    use WithTable;

    /**
     * Create a new repository instance.
     */
    public function __construct(protected GetAnggaranBelanjaSubRinci $model) {}

    public function getterKeys(): array
    {
        return [
            'id_rinci_sub_bl',
            'tahun',
            'id_daerah',
        ];
    }

    /**
     * Create a new instance of the given model.
     *
     * @param  array  $attributes
     * @return GetAnggaranBelanjaSubRinci
     */
    public function store($attributes)
    {
        return $this->create($attributes);
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return GetAnggaranBelanjaSubRinci
     */
    public function edit($attributes, GetAnggaranBelanjaSubRinci $getAnggaranBelanjaSubRinci)
    {
        return $this->update($attributes, $getAnggaranBelanjaSubRinci);
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null|void
     */
    public function destroy(GetAnggaranBelanjaSubRinci $getAnggaranBelanjaSubRinci)
    {
        return $this->delete($getAnggaranBelanjaSubRinci);
    }

    /**
     * Delete the model(s) from the database.
     *
     * @return bool|null|void
     */
    public function destroys(array $keys)
    {
        return $this->query()->whereIn('id', $keys)->delete();
    }

    public function truncate()
    {
        return $this->query()->truncate();
    }

    public function updateOrCreate(array $data)
    {
        $attributes = collect($data);
        $fillable = collect($this->model->getFillable());
        $keys = $this->getterKeys();

        $values = $attributes->only(
            $fillable->filter(fn ($item) => in_array($item, $keys))
        )->toArray();
        $update = $attributes->only($fillable->except($keys)->toArray())->toArray();
        $key = (string) collect($values)->flatten()->join('.');

        if ($model = Cache::get($this->model->getTable().'#'.$key)) {
            $model->fill($update);

            if (! $model->isDirty()) {
                return $model;
            }
        }

        $model = $this->model->updateOrCreate($values, $update);
        $model = $this->split($model);

        Cache::set($this->model->getTable().'#'.$key, $model, now()->addDay());

        return $model;
    }

    private function split(GetAnggaranBelanjaSubRinci $model)
    {
        $ks = explode(' x ', trim($model->koefisien));
        $a = [];
        foreach ($ks as $i => $k) {
            $n = collect(explode(' ', trim($k), 2));

            $a['koefisien_volume_'.($i + 1)] = $n->first() ?? '';
            $a['koefisien_satuan_'.($i + 1)] = $n->count() > 1 ? $n->last() : '';
        }

        $ks = explode(' x ', trim($model->koefisien_murni));
        foreach ($ks as $i => $k) {
            $n = collect(explode(' ', trim($k), 2));

            $a['koefisien_murni_volume_'.($i + 1)] = $n->first() ?? '';
            $a['koefisien_murni_satuan_'.($i + 1)] = $n->count() > 1 ? $n->last() : '';
        }

        $model->forceFill($a);
        $model->save();

        return $model;
    }
}
