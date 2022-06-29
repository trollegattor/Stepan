<?php

namespace App\Services\CategoryService;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
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
     * @param array $data
     * @return Category
     */
    public function create(StoreCategoryRequest $request): Category
    {
        $data = [
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'parent_id' => $request->input('parent_id'),
        ];
        /** @var Category $category */
        $category = Category::query()->create($data);

        return $category;
    }

    /**
     * @param int $id
     * @param array $data
     * @return Category
     */
    public function update(int $id, array $data): Category
    {
        /** @var Category $category */
        $category=Category::query()->find($id);
        $category->update($data);

        return $category;
    }

    /**
     * @param int $id
     * @return Category
     */
    public function show(int $id): Category
    {
        /** @var Category $category */
        $category=Category::query()->find($id);

        return $category;
    }

    /**
     * @param int $id
     * @return bool
     * @throws Throwable
     */
    public function destroy(int $id): bool
    {
        return Category::query()->where('id', $id)->delete();
    }

}
