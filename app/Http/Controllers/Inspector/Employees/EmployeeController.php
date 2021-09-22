<?php

namespace App\Http\Controllers\Inspector\Employees;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Employees\EmployeeRequest;
use App\Http\Resources\Employees\EmployeesResource;
use App\Models\Employees\Employee;
use Exception;
use App\Repositories\Employees\EmployeeRepository;
use App\Services\Employees\EmployeeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class EmployeeController extends ApiController
{
    public function __construct(
        private EmployeeRepository $employeeRepository,
        private EmployeeService $employeeService
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function __invoke(): Application|Factory|View
    {
        return view('inspector.employees.index', [
            'title' => __('inspector.employees.title')
        ]);
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function all(Request $request): AnonymousResourceCollection
    {
        $data = $this->employeeRepository->findBy(
            $request->all(),
            $request->get('ordering_column', 'id'),
            $request->get('ordering_sort', 'DESC'),
            $request->get('pagination', 20)
        );

        return EmployeesResource::collection($data);
    }

    /**
     * @param EmployeeRequest $request
     * @return Application|Factory|View|JsonResponse
     * @throws Exception
     */
    public function create(EmployeeRequest $request): Application|Factory|View|JsonResponse
    {
        if ($request->isMethod('POST')) {
            $this->employeeService->save($request->all());

            return $this->createdResponse();
        }

        return view('inspector.employees.form', [
            'title' => __('inspector.employees.form.create.title'),
            'item' => new Employee()
        ]);
    }

    /**
     * @param EmployeeRequest $request
     * @param int $id
     * @return Application|Factory|View|JsonResponse|RedirectResponse
     * @throws Exception
     */
    public function update(EmployeeRequest $request, int $id): Application|Factory|View|JsonResponse|RedirectResponse
    {
        $item = $this->employeeRepository->find($id);
        if (!$item) {
            return $this->noItem();
        }

        if ($request->isMethod('POST')) {
            $this->employeeService->save($request->all(), $item);

            return $this->updatedResponse();
        }

        return view('inspector.employees.form', [
            'title' => __('inspector.employees.form.edit.title'),
            'item' => $item
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function remove(int $id): JsonResponse
    {
        $item = $this->employeeRepository->find($id);
        if (!$item) {
            return $this->itemNoExist();
        }

        $this->employeeService->remove($item);

        return $this->successRemoved();
    }
}
