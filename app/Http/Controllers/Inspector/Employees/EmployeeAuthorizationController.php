<?php

namespace App\Http\Controllers\Inspector\Employees;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Employees\EmployeeAuthorizationRequest;
use App\Http\Resources\Employees\EmployeeAuthorizationResource;
use App\Repositories\Employees\EmployeeAuthorizationRepository;
use App\Services\Employees\EmployeeAuthorizationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class EmployeeAuthorizationController extends ApiController
{
    /**
     * @param EmployeeAuthorizationRepository $employeeAuthorizationRepository
     * @param EmployeeAuthorizationService $employeeAuthorizationService
     */
    public function __construct(
        private EmployeeAuthorizationRepository $employeeAuthorizationRepository,
        private EmployeeAuthorizationService $employeeAuthorizationService
    )
    {
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function all(Request $request): AnonymousResourceCollection
    {
        $data = $this->employeeAuthorizationRepository->findBy([
            'employee_id' => $request->get('employee_id')
        ]);

        return EmployeeAuthorizationResource::collection($data);
    }

    /**
     * @param EmployeeAuthorizationRequest $request
     * @return JsonResponse
     */
    public function save(EmployeeAuthorizationRequest $request): JsonResponse
    {
        $this->employeeAuthorizationService->save($request->all());

        return $this->createdResponse();
    }

    /**
     * @param EmployeeAuthorizationRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(EmployeeAuthorizationRequest $request, int $id): JsonResponse
    {
        $item = $this->employeeAuthorizationRepository->find($id);
        if (!$item) {
            return $this->itemNoExist();
        }

        $this->employeeAuthorizationService->save($request->all(), $item);

        return $this->updatedResponse();
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function remove(int $id): JsonResponse
    {
        $item = $this->employeeAuthorizationRepository->find($id);
        if (!$item) {
            return $this->itemNoExist();
        }

        $this->employeeAuthorizationService->remove($item);

        return $this->successRemoved();
    }
}
