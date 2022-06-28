<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DestroyUserRequest;
use App\Http\Requests\ShowUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdaterUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Throwable;

class UserController extends Controller
{
    /**
     * @param UserService $userService
     * @return AnonymousResourceCollection
     */
    public function index(UserService $userService): AnonymousResourceCollection
    {
        $user=$userService->getAll();

        return UserResource::collection($user);
    }

    /**
     * @param StoreUserRequest $request
     * @param UserService $userService
     * @return UserResource
     */
    public function store(StoreUserRequest $request, UserService $userService): UserResource
    {
        $protectPassword=bcrypt($request->input('password'));
        $data = [
            'login' => $request->input('login'),
            'password' => $protectPassword,
            'email' => $request->input('email'),
            'role_id' =>$request->input('role_id') ,
            'real_name' =>$request->input('real_name') ,
            'surname' =>$request->input('surname') ,
            ];
        $newUser=$userService->create($data);

        return new UserResource($newUser);

    }

    /**
     * @param ShowUserRequest $request
     * @param UserService $userService
     * @return UserResource
     */
    public function show(ShowUserRequest $request, UserService $userService): UserResource
    {
        $id=$request->route('user');
        $model=$userService->show($id);

        return new UserResource($model);
    }

    /**
     * @param UpdaterUserRequest $request
     * @param UserService $userService
     * @return UserResource
     */
    public function update(UpdaterUserRequest $request, UserService $userService): UserResource
    {
        $id=$request->route('user');
        $protectPassword=bcrypt($request->input('password'));
        $data = [
            'login' => $request->input('login'),
            'password' => $protectPassword,
            'email' => $request->input('email'),
            'role_id' =>$request->input('role_id') ,
            'real_name' =>$request->input('real_name') ,
            'surname' =>$request->input('surname') ,
        ];
        $updateUser=$userService->update($id,$data);

        return new UserResource($updateUser);
    }

    /**
     * @param DestroyUserRequest $request
     * @param UserService $userService
     * @return JsonResponse
     * @throws Throwable
     */
    public function destroy(DestroyUserRequest $request, UserService $userService): JsonResponse
    {
        $id=$request->route('user');

        return new JsonResponse($userService->destroy($id));
    }
}
