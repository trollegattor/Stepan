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
     * @return int
     */
    public function update(int $id,array $data): int
    {
        return Menu::query()->find('id',$id)->update($data);
    }

    /**
     * @param int $id
     * @return Menu
     */
    public function show(int $id): Menu
    {
        /** @var Menu $menu */
        $menu=Menu::query()->findOrFail($id);

        return $menu;
    }

    /**
     * @param int $id
     * @return bool
     * @throws Throwable
     */
    public function destroy(int $id): bool
    {
        return Menu::query()->find('id',$id)->find($id);
    }

}
