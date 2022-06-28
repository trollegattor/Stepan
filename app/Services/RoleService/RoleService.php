<?php

namespace App\Services\RoleService;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Throwable;

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
     * @param $data
     * @return Role
     */
    public function create(array $data): Role
    {
        /** @var Role $role */
        $role=Role::query()->create($data);

        return $role;
    }

    /**
     * @param int $id
     * @param array $data
     * @return Role
     */
    public function update(int $id, array $data): Role
    {
        /** @var Role $role */
        $role=Role::query()->find($id);
        $role->update($data);

        return $role;
    }

    /**
     * @param int $id
     * @return Role
     */
    public function show(int $id): Role
    {
        /** @var Role $role */
        $role=Role::query()->find($id);

        return $role;
    }

    /**
     * @param int $id
     * @return bool
     * @throws Throwable
     */
    public function destroy(int $id): bool
    {
        return Role::query()->where('id',$id)->delete();
    }

}
