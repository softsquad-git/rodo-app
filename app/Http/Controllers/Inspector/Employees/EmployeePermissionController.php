<?php

namespace App\Http\Controllers\Inspector\Employees;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Requests\Employees\EmployeePermissionRequest;
use App\Http\Resources\Employees\EmployeePermissionResource;
use App\Repositories\Employees\EmployeePermissionRepository;
use App\Services\Employees\EmployeePermissionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmployeePermissionController extends ApiController
{
    /**
     * @param EmployeePermissionRepository $employeePermissionRepository
     * @param EmployeePermissionService $employeePermissionService
     */
    public function __construct(
        private EmployeePermissionRepository $employeePermissionRepository,
        private EmployeePermissionService $employeePermissionService
    )
    {
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function all(Request $request): AnonymousResourceCollection
    {
        $data = $this->employeePermissionRepository->findBy(
            $request->all()
        );

        return EmployeePermissionResource::collection($data);
    }

    /**
     * @param EmployeePermissionRequest $request
     * @return JsonResponse
     */
    public function create(EmployeePermissionRequest $request): JsonResponse
    {
        $this->employeePermissionService->save($request->all());

        return $this->createdResponse();
    }

    /**
     * @param EmployeePermissionRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(EmployeePermissionRequest $request, int $id): JsonResponse
    {
        $item = $this->employeePermissionRepository->find($id);
        if (!$item) {
            return $this->itemNoExist();
        }

        $this->employeePermissionService->save($request->all(), $item);

        return $this->updatedResponse();
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function remove(int $id): JsonResponse
    {
        $item = $this->employeePermissionRepository->find($id);
        if (!$item) {
            return $this->itemNoExist();
        }

        $this->employeePermissionService->remove($item);

        return $this->successRemoved();
    }
}
