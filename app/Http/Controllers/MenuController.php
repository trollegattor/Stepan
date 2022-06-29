<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyMenuRequest;
use App\Http\Requests\ShowMenuRequest;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Http\Resources\MenuResource;
use App\Http\Resources\MenuResourceCollection;
use App\Services\MenuService\MenuService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Throwable;

class MenuController extends Controller
{
    /** @var MenuService $menuService */
    public MenuService $menuService;

    /**
     * @param MenuService $menuService
     */
    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    /**
     * @return MenuResourceCollection
     */
    public function index(): MenuResourceCollection
    {
        $menu = $this->menuService->getAll();

        return new MenuResourceCollection($menu);
    }

    /**
     * @param StoreMenuRequest $request
     * @return MenuResource
     */
    public function store(StoreMenuRequest $request,): MenuResource
    {
        $data = [
            'category_id' => $request->input('category_id'),
            'title' => $request->input('title'),
        ];
        $newMenu = $this->menuService->create($data);

        return new MenuResource($newMenu);
    }

    /**
     * @param ShowMenuRequest $request
     * @return MenuResource
     */
    public function show(ShowMenuRequest $request): MenuResource
    {
        $id = $request->route('menu');
        $model = $this->menuService->show($id);

        return new MenuResource($model);
    }

    /**
     * @param UpdateMenuRequest $request
     * @return MenuResource
     */
    public function update(UpdateMenuRequest $request): MenuResource
    {
        $id = $request->route('menu');
        $data = [
            'category_id' => $request->input('category_id'),
            'title' => $request->input('title'),
        ];
        $updateMenu = $this->menuService->update($id, $data);

        return new MenuResource($updateMenu);
    }

    /**
     * @param DestroyMenuRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function destroy(DestroyMenuRequest $request): JsonResponse
    {
        $id = $request->route('menu');

        return new JsonResponse($this->menuService->destroy($id));
    }
}
