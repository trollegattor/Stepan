<?php

namespace App\Services\RoleService;

use App\Http\Requests\DestroyRoleRequest;
use App\Http\Requests\ShowRoleRequest;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

class RoleService
{

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Role::all();
    }

    /**
     * @param StoreRoleRequest $request
     * @return Role
     */
    public function create(StoreRoleRequest $request): Role
    {
        $data = [
            'name' => $request->input('name'),

            'category_index' => $request->input('category_index', default: false),
            'category_store' => $request->input('category_store', default: false),
            'category_show' => $request->input('category_show', default: false),
            'category_update' => $request->input('category_update', default: false),
            'category_destroy' => $request->input('category_destroy', default: false),


            'menu_index' => $request->input('menu_index', default: false),
            'menu_store' => $request->input('menu_store', default: false),
            'menu_show' => $request->input('menu_show', default: false),
            'menu_update' => $request->input('menu_update', default: false),
            'menu_destroy' => $request->input('menu_destroy', default: false),


            'article_index' => $request->input('article_index', default: false),
            'article_store' => $request->input('article_store', default: false),
            'article_show' => $request->input('article_show', default: false),
            'article_update_all' => $request->input('article_update_all', default: false),
            'article_update_own' => $request->input('article_update_own', default: false),
            'article_destroy_all' => $request->input('article_destroy_all', default: false),
            'article_destroy_own' => $request->input('article_destroy_own', default: false),

            'user_index' => $request->input('user_index', default: false),
            'user_store' => $request->input('user_store', default: false),
            'user_show_all' => $request->input('user_show_all', default: false),
            'user_show_own' => $request->input('user_show_own', default: false),
            'user_update_all' => $request->input('user_update_all', default: false),
            'user_update_own' => $request->input('user_update_own', default: false),
            'user_destroy_all' => $request->input('user_destroy_all', default: false),
            'user_destroy_own' => $request->input('user_destroy_own', default: false),

            'role_index' => $request->input('role_index', default: false),
            'role_show' => $request->input('role_show', default: false),
            'role_update' => $request->input('role_update', default: false),
            'role_destroy' => $request->input('role_destroy', default: false),
        ];
        /** @var Role $role */
        $role = Role::query()->create($data);

        return $role;
    }

    /**
     * @param UpdateRoleRequest $request
     * @return Role
     */
    public function update(UpdateRoleRequest $request): Role
    {
        $id = $request->route('role');
        $data = [

            'name' => $request->input('name'),
            'category_index' => $request->input('category_index', default: false),
            'category_store' => $request->input('category_store', default: false),
            'category_show' => $request->input('category_show', default: false),
            'category_update' => $request->input('category_update', default: false),
            'category_destroy' => $request->input('category_destroy', default: false),


            'menu_index' => $request->input('menu_index', default: false),
            'menu_store' => $request->input('menu_store', default: false),
            'menu_show' => $request->input('menu_show', default: false),
            'menu_update' => $request->input('menu_update', default: false),
            'menu_destroy' => $request->input('menu_destroy', default: false),


            'article_index' => $request->input('article_index', default: false),
            'article_store' => $request->input('article_store', default: false),
            'article_show' => $request->input('article_show', default: false),
            'article_update_all' => $request->input('article_update_all', default: false),
            'article_update_own' => $request->input('article_update_own', default: false),
            'article_destroy_all' => $request->input('article_destroy_all', default: false),
            'article_destroy_own' => $request->input('article_destroy_own', default: false),

            'user_index' => $request->input('user_index', default: false),
            'user_store' => $request->input('user_store', default: false),
            'user_show_all' => $request->input('user_show_all', default: false),
            'user_show_own' => $request->input('user_show_own', default: false),
            'user_update_all' => $request->input('user_update_all', default: false),
            'user_update_own' => $request->input('user_update_own', default: false),
            'user_destroy_all' => $request->input('user_destroy_all', default: false),
            'user_destroy_own' => $request->input('user_destroy_own', default: false),

            'role_index' => $request->input('role_index', default: false),
            'role_show' => $request->input('role_show', default: false),
            'role_update' => $request->input('role_update', default: false),
            'role_destroy' => $request->input('role_destroy', default: false),
        ];
        /** @var Role $role */
        $role = Role::query()->find($id);
        $role->update($data);

        return $role;
    }

    /**
     * @param ShowRoleRequest $request
     * @return Role
     */
    public function show(ShowRoleRequest $request): Role
    {
        $id = $request->route('role');
        /** @var Role $role */
        $role = Role::query()->find($id);

        return $role;
    }

    /**
     * @param DestroyRoleRequest $request
     * @return bool
     */
    public function destroy(DestroyRoleRequest $request): bool
    {
        $id = $request->route('role');

        return Role::query()->where('id', $id)->delete();
    }
}
