<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShowMenuRequest;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Http\Resources\MenuResource;
use App\Models\Menu;
use App\Services\MenuService\MenuService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Throwable;

class MenuController extends Controller
{
    /**
     * @param MenuService $menuService
     * @return AnonymousResourceCollection
     */
    public function index(MenuService $menuService): AnonymousResourceCollection
    {
        $menu = $menuService->getAll();

        return MenuResource::collection($menu);
    }

    /**
     * @param StoreMenuRequest $request
     * @param MenuService $menuService
     * @return MenuResource
     */
    public function store(StoreMenuRequest $request, MenuService $menuService): MenuResource
    {
        $data = [
            'category_id' => $request->input('category_id'),
            'title' => $request->input('title'),
        ];
        $newMenu = $menuService->create($data);

        return new MenuResource($newMenu);
    }

    /**
     * @param ShowMenuRequest $request
     * @param MenuService $menuService
     * @return MenuResource
     */
    public function show(ShowMenuRequest $request, MenuService $menuService): MenuResource
    {
        $id=$request->route('menu');
        $model = $menuService->show($id);

        return new MenuResource($model);
    }

    /**
     * @param UpdateMenuRequest $request
     * @param MenuService $menuService
     * @return MenuResource
     */
    public function update(UpdateMenuRequest $request, MenuService $menuService): MenuResource
    {
        $id=$request->route('menu');
        $data = [
            'category_id' => $request->input('category_id'),
            'title' => $request->input('title'),
        ];
        $updateMenu = $menuService->update($id, $data);

        return new MenuResource($updateMenu);
    }

    /**
     * @param ShowMenuRequest $request
     * @param MenuService $menuService
     * @return JsonResponse
     * @throws Throwable
     */
    public function destroy(ShowMenuRequest $request, MenuService $menuService): JsonResponse
    {
        $id=$request->route('menu');

        return new JsonResponse($menuService->destroy($id));
    }
}
