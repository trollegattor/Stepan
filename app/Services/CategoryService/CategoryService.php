<?php

namespace App\Services\CategoryService;

use App\Http\Requests\DestroyCategoryRequest;
use App\Http\Requests\ShowCategoryRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

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
     * @param UpdateCategoryRequest $request
     * @return Category
     */
    public function update(UpdateCategoryRequest $request): Category
    {
        $id = $request->route('category');
        $data = [
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'parent_id' => $request->input('parent_id')
        ];
        /** @var Category $category */
        $category = Category::query()->find($id);
        $category->update($data);

        return $category;
    }

    /**
     * @param ShowCategoryRequest $request
     * @return Category
     */
    public function show(ShowCategoryRequest $request): Category
    {
        $id = $request->route('category');
        /** @var Category $category */
        $category = Category::query()->find($id);

        return $category;
    }

    /**
     * @param DestroyCategoryRequest $request
     * @return bool
     */
    public function destroy(DestroyCategoryRequest $request): bool
    {
        $id = $request->route('category');

        return Category::query()->where('id', $id)->delete();
    }
}
