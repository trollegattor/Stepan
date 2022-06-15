<?php

namespace App\Services\CategoryService;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Throwable;

class CategoryService
{

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Category::all();
    }

    /**
     * @param $data
     * @return Builder|Model
     */
    public function create($data): Model|Builder
    {
        return Category::query()->create($data);
    }

    /**
     * @param $id
     * @param $data
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function update($id, $data): Model|Collection|Builder|array|null
    {
        $model = Category::query()->findOrFail($id);
        $model->update($data);

        return $model;
    }

    /**
     * @param int $id
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function show(int $id): Model|Collection|Builder|array|null
    {
        return Category::query()->findOrFail($id);
    }

    /**
     * @param int $id
     * @return bool|null
     * @throws Throwable
     */
    public function destroy(int $id): ?bool
    {
        $model = Category::query()->findOrFail($id);

        return $model->deleteOrFail();
    }

}
