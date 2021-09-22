<?php

namespace App\Http\Controllers\Inspector\Departments;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Departments\DepartmentRequest;
use App\Http\Resources\Departments\DepartmentResource;
use App\Models\Departments\Department;
use App\Repositories\Departments\DepartmentRepository;
use App\Repositories\Settings\StatusRepository;
use App\Services\Departments\DepartmentService;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\RedirectResponse;

class DepartmentController extends ApiController
{
    /**
     * @param DepartmentRepository $departmentRepository
     * @param DepartmentService $departmentService
     * @param StatusRepository $statusRepository
     */
    public function __construct(
        private DepartmentRepository $departmentRepository,
        private DepartmentService    $departmentService,
        private StatusRepository     $statusRepository
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function __invoke(): Application|Factory|View
    {
        return view('inspector.departments.index', [
            'title' => __('inspector.departments.title')
        ]);
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function all(Request $request): AnonymousResourceCollection
    {
        $data = $this->departmentRepository->findBy(
            $request->all(),
            $request->get('ordering_column', 'id'),
            $request->get('ordering_sort', 'DESC'),
            $request->get('pagination', 20)
        );

        return DepartmentResource::collection($data);
    }

    /**
     * @param DepartmentRequest $request
     * @return Application|Factory|View|RedirectResponse
     */
    public function create(DepartmentRequest $request): Application|Factory|View|RedirectResponse
    {
        if ($request->isMethod('POST')) {
            $this->departmentService->save($request->all());

            return redirect()->route('inspector.departments.index')
                ->with('notification.success', 'inspector.notifications.created');
        }

        return view('inspector.departments.form', [
            'item' => new Department(),
            'title' => __('inspector.departments.form.create.title'),
            'statuses' => $this->statusRepository->findAll(Department::$resourceType)
        ]);
    }

    /**
     * @param DepartmentRequest $request
     * @param int $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function update(DepartmentRequest $request, int $id): Application|Factory|View|RedirectResponse
    {
        $item = $this->departmentRepository->find($id);
        if (!$item) {
            return $this->noItem();
        }

        if ($request->isMethod('POST')) {

            $this->departmentService->save($request->all(), $item);

            return redirect()->route('inspector.departments.index')
                ->with('notification.success', 'inspector.notifications.updated');
        }

        return view('inspector.departments.form', [
            'item' => $item,
            'title' => __('inspector.departments.form.edit.title'),
            'statuses' => $this->statusRepository->findAll(Department::$resourceType)
        ]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function remove(int $id): RedirectResponse
    {
        $item = $this->departmentRepository->find($id);
        if (!$item) {
            return $this->noItem();
        }

        $this->departmentService->remove($item);

        return redirect()->route('inspector.departments.index')
            ->with('notification.success', 'inspector.notifications.deleted');
    }
}
