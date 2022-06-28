<?php

namespace App\Services\UserService;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Throwable;

class UserService
{

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return User::all();
    }

    /**
     * @param $data
     * @return User
     */
    public function create(array $data): User
    {
        /** @var User $user */
        $user=User::query()->create($data);

        return $user;
    }

    /**
     * @param int $id
     * @param array $data
     * @return User
     */
    public function update(int $id, array $data): User
    {
        /** @var User $user */
        $user=User::query()->find($id);
        $user->update($data);

        return $user;
    }

    /**
     * @param int $id
     * @return User
     */
    public function show(int $id): User
    {
        /** @var User $user */
        $user=User::query()->find($id);

        return $user;
    }

    /**
     * @param int $id
     * @return bool
     * @throws Throwable
     */
    public function destroy(int $id): bool
    {
        return User::query()->where('id',$id)->delete();
    }

}
