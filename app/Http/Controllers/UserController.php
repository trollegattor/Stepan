<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyUserRequest;
use App\Http\Requests\ShowUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserResourceCollection;
use App\Services\UserService\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Throwable;
use function bcrypt;

class UserController extends Controller
{
    /** @var UserService $userService */
    public UserService $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return UserResourceCollection
     */
    public function index(): UserResourceCollection
    {
        $user = $this->userService->getAll();

        return new UserResourceCollection($user);
    }

    /**
     * @param StoreUserRequest $request
     * @return UserResource
     */
    public function store(StoreUserRequest $request): UserResource
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
        $newUser = $this->userService->create($data);

        return new UserResource($newUser);

    }

    /**
     * @param ShowUserRequest $request
     * @return UserResource
     */
    public function show(ShowUserRequest $request): UserResource
    {
        $id = $request->route('user');
        $model = $this->userService->show($id);

        return new UserResource($model);
    }

    /**
     * @param UpdateUserRequest $request
     * @return UserResource
     */
    public function update(UpdateUserRequest $request): UserResource
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
        $updateUser = $this->userService->update($id, $data);

        return new UserResource($updateUser);
    }

    /**
     * @param DestroyUserRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function destroy(DestroyUserRequest $request): JsonResponse
    {
        $id = $request->route('user');

        return new JsonResponse($this->userService->destroy($id));
    }
}
