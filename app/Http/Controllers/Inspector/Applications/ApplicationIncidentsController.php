<?php

namespace App\Http\Controllers\Inspector\Applications;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Applications\ApplicationIncidentRequest;
use App\Http\Resources\Applications\ApplicationIncidentsResource;
use App\Models\Applications\ApplicationIncident;
use App\Repositories\Applications\ApplicationIncidentRepository;
use App\Services\Applications\ApplicationIncidentService;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\JsonResponse;

class ApplicationIncidentsController extends ApiController
{
    /**
     * @param ApplicationIncidentRepository $applicationIncidentRepository
     * @param ApplicationIncidentService $applicationIncidentService
     */
    public function __construct(
        private ApplicationIncidentRepository $applicationIncidentRepository,
        private ApplicationIncidentService    $applicationIncidentService
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function __invoke(): Application|Factory|View
    {
        return view('inspector.applications.incidents.index', [
            'title' => __('inspector.applications.incidents.title')
        ]);
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function all(Request $request): AnonymousResourceCollection
    {
        $data = $this->applicationIncidentRepository->findBy(
            $request->all(),
            $request->get('ordering_column', 'id'),
            $request->get('ordering_sort', 'DESC'),
            $request->get('pagination')
        );

        return ApplicationIncidentsResource::collection($data);
    }

    /**
     * @param ApplicationIncidentRequest $request
     * @return Application|Factory|View|JsonResponse
     * @throws Exception
     */
    public function create(ApplicationIncidentRequest $request): Application|Factory|View|JsonResponse
    {
        if ($request->isMethod('POST')) {
            $this->applicationIncidentService->save($request->all());

            return $this->createdResponse();
        }

        return view('inspector.applications.incidents.form', [
            'title' => __('inspector.applications.incidents.form.create.title'),
            'item' => new ApplicationIncident()
        ]);
    }

    /**
     * @param ApplicationIncidentRequest $request
     * @param int $id
     * @return Application|Factory|View|JsonResponse
     * @throws Exception
     */
    public function update(ApplicationIncidentRequest $request, int $id): Application|Factory|View|JsonResponse
    {
        $item = $this->applicationIncidentRepository->find($id);
        if (!$item) {
            return $this->itemNoExist();
        }

        if ($request->isMethod('POST')) {
            $this->applicationIncidentService->save($request->all(), $item);

            return $this->updatedResponse();
        }

        return view('inspector.applications.incidents.form', [
            'title' => __('inspector.applications.incidents.form.edit.title'),
            'item' => $item
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function remove(int $id): JsonResponse
    {
        $item = $this->applicationIncidentRepository->find($id);
        if (!$item) {
            return $this->itemNoExist();
        }

        $this->applicationIncidentService->remove($item);

        return $this->successRemoved();
    }
}
