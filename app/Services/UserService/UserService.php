<?php

namespace App\Services\UserService;

use App\Http\Requests\DestroyUserRequest;
use App\Http\Requests\ShowUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

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
     * @param StoreUserRequest $request
     * @return User
     */
    public function create(StoreUserRequest $request): User
    {
        $protectPassword = bcrypt($request->input('password'));
        $data = [
            'login' => $request->input('login'),
            'password' => $protectPassword,
            'email' => $request->input('email'),
            'role_id' => $request->input('role_id'),
            'real_name' => $request->input('real_name'),
            'surname' => $request->input('surname'),
        ];
        /** @var User $user */
        $user = User::query()->create($data);

        return $user;
    }

    /**
     * @param UpdateUserRequest $request
     * @return User
     */
    public function update(UpdateUserRequest $request): User
    {
        $id = $request->route('user');
        $protectPassword = bcrypt($request->input('password'));
        $data = [
            'login' => $request->input('login'),
            'password' => $protectPassword,
            'email' => $request->input('email'),
            'role_id' => $request->input('role_id'),
            'real_name' => $request->input('real_name'),
            'surname' => $request->input('surname'),
        ];
        /** @var User $user */
        $user = User::query()->find($id);
        $user->update($data);

        return $user;
    }

    /**
     * @param ShowUserRequest $request
     * @return User
     */
    public function show(ShowUserRequest $request): User
    {
        $id = $request->route('user');
        /** @var User $user */
        $user = User::query()->find($id);

        return $user;
    }

    /**
     * @param DestroyUserRequest $request
     * @return bool
     */
    public function destroy(DestroyUserRequest $request): bool
    {
        $id = $request->route('user');

        return User::query()->where('id', $id)->delete();
    }
}
