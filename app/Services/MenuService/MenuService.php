<?php

namespace App\Services\MenuService;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Throwable;

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
     * @param $data
     * @return Menu
     */
    public function create(array $data): Menu
    {
        /** @var Menu $menu */
        $menu=Menu::query()->create($data);

        return $menu;
    }

    /**
     * @param int $id
     * @param array $data
     * @return Menu
     */
    public function update(int $id,array $data): Menu
    {
        /** @var Menu $menu */
        $menu=Menu::query()->find($id);
        $menu->update($data);

        return $menu;
    }

    /**
     * @param int $id
     * @return Menu
     */
    public function show(int $id): Menu
    {
        /** @var Menu $menu */
        $menu=Menu::query()->find($id);

        return $menu;
    }

    /**
     * @param int $id
     * @return bool
     * @throws Throwable
     */
    public function destroy(int $id): bool
    {
        return Menu::query()->where('id',$id)->delete();
    }

}
