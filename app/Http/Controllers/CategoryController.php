<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyCategoryRequest;
use App\Http\Requests\ShowCategoryRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryResourceCollection;
use App\Services\CategoryService\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Throwable;

class CategoryController extends Controller
{
    /** @var CategoryService $categoryService */
    public CategoryService $categoryService;

    /**
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * @return CategoryResourceCollection
     */
    public function index(): CategoryResourceCollection
    {
        $categories = $this->categoryService->getAll();

        return new CategoryResourceCollection($categories);
    }

    /**
     * @param StoreCategoryRequest $request
     * @return CategoryResource
     */
    public function store(StoreCategoryRequest $request): CategoryResource
    {

        $newCategory = $this->categoryService->create($request);

        return new CategoryResource($newCategory);
    }

    /**
     * @param ShowCategoryRequest $request
     * @return CategoryResource
     */
    public function show(ShowCategoryRequest $request): CategoryResource
    {
        $id = $request->route('category');
        $model = $this->categoryService->show($id);

        return new CategoryResource($model);

    }

    /**
     * @param UpdateCategoryRequest $request
     * @return CategoryResource
     */
    public function update(UpdateCategoryRequest $request): CategoryResource
    {
        $id = $request->route('category');
        $data = [
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'parent_id' => $request->input('parent_id')
        ];
        $updateCategory = $this->categoryService->update($id, $data);

        return new CategoryResource($updateCategory);
    }

    /**
     * @param DestroyCategoryRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function destroy(DestroyCategoryRequest $request): JsonResponse
    {
        $id = $request->route('category');

        return new JsonResponse($this->categoryService->destroy($id));
    }
}
