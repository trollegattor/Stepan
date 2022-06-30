<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyUserRequest;
use App\Http\Requests\ShowAllUserRequest;
use App\Http\Requests\ShowUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserResourceCollection;
use App\Services\UserService\UserService;
use Illuminate\Http\JsonResponse;

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
    public function index(ShowAllUserRequest $showAllUserRequest): UserResourceCollection
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
        $newUser = $this->userService->create($request);

        return new UserResource($newUser);
    }

    /**
     * @param ShowUserRequest $request
     * @return UserResource
     */
    public function show(ShowUserRequest $request): UserResource
    {
        $model = $this->userService->show($request);

        return new UserResource($model);
    }

    /**
     * @param UpdateUserRequest $request
     * @return UserResource
     */
    public function update(UpdateUserRequest $request): UserResource
    {
        $updateUser = $this->userService->update($request);

        return new UserResource($updateUser);
    }

    /**
     * @param DestroyUserRequest $request
     * @return JsonResponse
     */
    public function destroy(DestroyUserRequest $request): JsonResponse
    {
        return new JsonResponse($this->userService->destroy($request));
    }
}
