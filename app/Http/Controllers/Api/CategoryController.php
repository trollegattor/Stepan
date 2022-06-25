<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShowCategoryRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\User;
use App\Services\CategoryService\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Throwable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CategoryController extends Controller
{

    /*public function __construct()
    {
        $this->authorizeResource(Category::class, 'category');
    }*/
    /**
     * Display a listing of the resource.
     *
     * @param CategoryService $categoryService
     * @return AnonymousResourceCollection
     */
    public function index(CategoryService $categoryService): AnonymousResourceCollection
    {
        $categories = $categoryService->getAll();

        return CategoryResource::collection($categories);
    }

    /**
     * @param StoreCategoryRequest $request
     * @param CategoryService $categoryService
     * @return CategoryResource
     */
    public function store(StoreCategoryRequest $request, CategoryService $categoryService): CategoryResource
    {
        $data = [
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'parent_id' => $request->input('parent_id'),
        ];
        $newCategory = $categoryService->create($data);

        return new CategoryResource($newCategory);
    }

    /**
     * @param ShowCategoryRequest $request
     * @param CategoryService $categoryService
     * @return string[]
     */
    public function show(ShowCategoryRequest $request, CategoryService $categoryService)
    {
        //print_r($category);

        //$id=$request->route('category');
        //$model = $categoryService->show($id);

        return ['new CategoryResource($model)'];

    }

    /**
     * @param UpdateCategoryRequest $request
     * @param CategoryService $categoryService
     * @return CategoryResource
     */
    public function update(UpdateCategoryRequest $request, CategoryService $categoryService): CategoryResource
    {
        $id=$request->route('category');
        $data = [
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'parent_id' => $request->input('parent_id')
        ];
        $updateCategory = $categoryService->update($id, $data);

        return new CategoryResource($updateCategory);
    }

    /**
     * @param ShowCategoryRequest $request
     * @param CategoryService $categoryService
     * @return JsonResponse
     * @throws Throwable
     */
    public function destroy(ShowCategoryRequest $request, CategoryService $categoryService): JsonResponse
    {

        $id=$request->route('category');

        return new JsonResponse($categoryService->destroy($id));
    }
}
