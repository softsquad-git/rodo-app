<?php

namespace App\Http\Controllers\Inspector\ProcessingAreas;

use App\Http\Controllers\ApiController;
use App\Http\Requests\ProcessingAreas\ProcessingAreaRequest;
use App\Http\Resources\RiskAnalysis\SecurityResource;
use App\Models\ProcessingAreas\ProcessingArea;
use App\Models\RiskAnalysis\Security;
use App\Services\ProcessingAreas\ProcessingAreaService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Resources\ProcessingAreas\ProcessingAreaResource;
use App\Repositories\ProcessingAreas\ProcessingAreaRepository;
use App\Repositories\RiskAnalysis\SecurityRepository;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Exception;

class ProcessingAreaController extends ApiController
{
    /**
     * @param SecurityRepository $securityRepository
     * @param ProcessingAreaRepository $processingAreaRepository
     * @param ProcessingAreaService $processingAreaService
     */
    public function __construct(
        private SecurityRepository       $securityRepository,
        private ProcessingAreaRepository $processingAreaRepository,
        private ProcessingAreaService    $processingAreaService
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function __invoke(): Application|Factory|View
    {
        return view('inspector.processing_areas.index', [
            'title' => __('inspector.processing_areas.title')
        ]);
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function all(Request $request): AnonymousResourceCollection
    {
        $data = $this->processingAreaRepository->findBy(
            $request->all(),
            $request->get('ordering_column', 'id'),
            $request->get('ordering_sort', 'DESC'),
            $request->get('pagination', 20)
        );

        return ProcessingAreaResource::collection($data);
    }

    /**
     * @param ProcessingAreaRequest $request
     * @return Application|Factory|View|JsonResponse
     * @throws Exception
     */
    public function create(ProcessingAreaRequest $request): Application|Factory|View|JsonResponse
    {
        if ($request->isMethod('POST')) {
            $this->processingAreaService->save($request->all());

            return $this->createdResponse();
        }

        return view('inspector.processing_areas.form', [
            'title' => __('inspector.processing_areas.form.create.title'),
            'item' => new ProcessingArea(),
            'security' => $this->securityRepository->findBy(['type' => Security::$types['physical']]),
            'processingAreas' => $this->processingAreaRepository->findBy([])
        ]);
    }

    /**
     * @param ProcessingAreaRequest $request
     * @param int $id
     * @return Application|Factory|View|JsonResponse|RedirectResponse
     * @throws Exception
     */
    public function update(ProcessingAreaRequest $request, int $id): Application|Factory|View|JsonResponse|RedirectResponse
    {
        $item = $this->processingAreaRepository->find($id);
        if (!$item) {
            return $this->noItem();
        }

        if ($request->isMethod('POST')) {
            $this->processingAreaService->save($request->all(), $item);

            return $this->updatedResponse();
        }

        return view('inspector.processing_areas.form', [
            'title' => __('inspector.processing_areas.form.edit.title'),
            'item' => $item,
            'security' => $this->securityRepository->findBy(['type' => Security::$types['physical']]),
            'processingAreas' => $this->processingAreaRepository->findBy([])
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function remove(int $id): JsonResponse
    {
        $item = $this->processingAreaRepository->find($id);
        if (!$item) {
            return $this->itemNoExist();
        }

        $this->processingAreaService->remove($item);

        return $this->successRemoved();
    }
}
