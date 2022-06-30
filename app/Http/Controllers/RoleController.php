<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyRoleRequest;
use App\Http\Requests\ShowAllRoleRequest;
use App\Http\Requests\ShowRoleRequest;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Resources\RoleResource;
use App\Http\Resources\RoleResourceCollection;
use App\Services\RoleService\RoleService;
use Illuminate\Http\JsonResponse;

class RoleController extends Controller
{
    /** @var RoleService $roleService */
    public RoleService $roleService;

    /**
     * @param RoleService $roleService
     */
    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    /**
     * @param ShowAllRoleRequest $showAllRoleRequest
     * @return RoleResourceCollection
     */
    public function index(ShowAllRoleRequest $showAllRoleRequest): RoleResourceCollection
    {
        $role = $this->roleService->getAll();

        return new RoleResourceCollection($role);
    }

    /**
     * @param StoreRoleRequest $request
     * @return RoleResource
     */
    public function store(StoreRoleRequest $request): RoleResource
    {
        $newRole = $this->roleService->create($request);

        return new RoleResource($newRole);
    }

    /**
     * @param ShowRoleRequest $request
     * @return RoleResource
     */
    public function show(ShowRoleRequest $request): RoleResource
    {
        $model = $this->roleService->show($request);

        return new RoleResource($model);
    }

    /**
     * @param UpdateRoleRequest $request
     * @return RoleResource
     */
    public function update(UpdateRoleRequest $request): RoleResource
    {
        $updateRole = $this->roleService->update($request);

        return new RoleResource($updateRole);
    }

    /**
     * @param DestroyRoleRequest $request
     * @return JsonResponse
     */
    public function destroy(DestroyRoleRequest $request): JsonResponse
    {
        return new JsonResponse($this->roleService->destroy($request));
    }
}
