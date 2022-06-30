<?php

namespace App\Services\MenuService;

use App\Http\Requests\DestroyMenuRequest;
use App\Http\Requests\ShowMenuRequest;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Models\Menu;
use Illuminate\Database\Eloquent\Collection;

class MenuService
{

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Menu::all();
    }

    /**
     * @param StoreMenuRequest $request
     * @return Menu
     */
    public function create(StoreMenuRequest $request): Menu
    {
        $data = [
            'category_id' => $request->input('category_id'),
            'title' => $request->input('title'),
        ];
        /** @var Menu $menu */
        $menu=Menu::query()->create($data);

        return $menu;
    }

    /**
     * @param UpdateMenuRequest $request
     * @return Menu
     */
    public function update(UpdateMenuRequest $request): Menu
    {
        $id = $request->route('menu');
        $data = [
            'category_id' => $request->input('category_id'),
            'title' => $request->input('title'),
        ];
        /** @var Menu $menu */
        $menu=Menu::query()->find($id);
        $menu->update($data);

        return $menu;
    }

    /**
     * @param ShowMenuRequest $request
     * @return Menu
     */
    public function show(ShowMenuRequest $request): Menu
    {
        $id = $request->route('menu');
        /** @var Menu $menu */
        $menu=Menu::query()->find($id);

        return $menu;
    }

    /**
     * @param DestroyMenuRequest $request
     * @return bool
     */
    public function destroy(DestroyMenuRequest $request): bool
    {
        $id = $request->route('menu');

        return Menu::query()->where('id',$id)->delete();
    }
}
