<?php

namespace App\Http\Controllers\Inspector\Applications;

use App\Http\Controllers\ApiController;
use App\Repositories\Employees\EmployeeRepository;
use Exception;
use App\Http\Requests\Applications\ApplicationConclusionRequest;
use App\Http\Resources\Applications\ApplicationConclusionsResource;
use App\Models\Applications\ApplicationConclusion;
use App\Repositories\Applications\ApplicationConclusionRepository;
use App\Repositories\Settings\StatusRepository;
use App\Repositories\Settings\TypeRepository;
use App\Services\Applications\ApplicationConclusionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\RedirectResponse;
use phpDocumentor\Reflection\Types\String_;

class ApplicationConclusionController extends ApiController
{
    public function __construct(
        private ApplicationConclusionRepository $applicationConclusionRepository,
        private ApplicationConclusionService    $applicationConclusionService,
        private TypeRepository                  $typeRepository,
        private StatusRepository                $statusRepository,
        private EmployeeRepository              $employeeRepository
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function __invoke(): Application|Factory|View
    {
        return view('inspector.applications.conclusions.index', [
            'title' => __('inspector.applications.conclusions.title')
        ]);
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function all(Request $request): AnonymousResourceCollection
    {
        $data = $this->applicationConclusionRepository->findBy(
            $request->all(),
            $request->get('ordering_column', 'id'),
            $request->get('ordering_sort', 'DESC'),
            $request->get('pagination', 20)
        );

        return ApplicationConclusionsResource::collection($data);
    }

    /**
     * @param ApplicationConclusionRequest $request
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function create(ApplicationConclusionRequest $request): Application|Factory|View|RedirectResponse
    {
        if ($request->isMethod('POST')) {
            $this->applicationConclusionService->save($request->all());

            return redirect()->route('inspector.applications.conclusions.index')
                ->with('notification.success', __('inspector.notifications.created'));
        }

        return view('inspector.applications.conclusions.form', [
            'item' => new ApplicationConclusion(),
            'title' => __('inspector.applications.conclusions.form.create.title'),
            'statuses' => $this->statusRepository->findAll(ApplicationConclusion::$resourceType),
            'types' => $this->typeRepository->findAll(ApplicationConclusion::$resourceType),
            'employees' => $this->employeeRepository->findBy([], 'id', 'DESC', 20)
        ]);
    }

    /**
     * @param ApplicationConclusionRequest $request
     * @param int $id
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function update(ApplicationConclusionRequest $request, int $id): Application|Factory|View|RedirectResponse
    {
        $item = $this->applicationConclusionRepository->find($id);
        if (!$item) {
            return $this->noItem();
        }

        if ($request->isMethod('POST')) {
            $this->applicationConclusionService->save($request->all(), $item);

            return redirect()->route('inspector.applications.conclusions.index')
                ->with('notification.success', __('inspector.notifications.updated'));
        }

        return view('inspector.applications.conclusions.form', [
            'item' => $item,
            'title' => __('inspector.applications.conclusions.form.edit.title'),
            'statuses' => $this->statusRepository->findAll(ApplicationConclusion::$resourceType),
            'types' => $this->typeRepository->findAll(ApplicationConclusion::$resourceType),
            'employees' => $this->employeeRepository->findBy([], 'id', 'DESC', 20)
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function remove(int $id): JsonResponse
    {
        $item = $this->applicationConclusionRepository->find($id);
        if (!$item) {
            return $this->itemNoExist();
        }

        $this->applicationConclusionService->remove($item);

        return $this->successRemoved();
    }
}
