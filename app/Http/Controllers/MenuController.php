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
    public function store(StoreMenuRequest $request): MenuResource
    {
        $newMenu = $this->menuService->create($request);

        return new MenuResource($newMenu);
    }

    /**
     * @param ShowMenuRequest $request
     * @return MenuResource
     */
    public function show(ShowMenuRequest $request): MenuResource
    {
        $model = $this->menuService->show($request);

        return new MenuResource($model);
    }

    /**
     * @param UpdateMenuRequest $request
     * @return MenuResource
     */
    public function update(UpdateMenuRequest $request): MenuResource
    {
        $updateMenu = $this->menuService->update($request);

        return new MenuResource($updateMenu);
    }

    /**
     * @param DestroyMenuRequest $request
     * @return JsonResponse
     */
    public function destroy(DestroyMenuRequest $request): JsonResponse
    {
        return new JsonResponse($this->menuService->destroy($request));
    }
}
