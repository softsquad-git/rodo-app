<?php

namespace App\Http\Controllers\Inspector\Datasets;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Datasets\DatasetRequest;
use App\Http\Resources\Datasets\DatasetResource;
use App\Models\DataSets\Dataset;
use App\Repositories\Assets\ResourceRepository;
use App\Repositories\Assets\SystemItRepository;
use App\Repositories\Datasets\DatasetRepository;
use App\Repositories\ProcessingAreas\ProcessingAreaRepository;
use App\Repositories\RCP\LawBasicRepository;
use App\Repositories\Settings\StatusRepository;
use App\Repositories\Settings\TypeRepository;
use App\Services\Datasets\DatasetService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Exception;

class DatasetController extends ApiController
{

    public function __construct(
        private DatasetRepository        $datasetRepository,
        private DatasetService           $datasetService,
        private TypeRepository           $typeRepository,
        private ResourceRepository       $resourceRepository,
        private SystemItRepository       $systemItRepository,
        private StatusRepository         $statusRepository,
        private ProcessingAreaRepository $processingAreaRepository,
        private LawBasicRepository       $lawBasicRepository,

    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function __invoke(): Application|Factory|View
    {
        return view('inspector.datasets.index', [
            'title' => __('inspector.datasets.title')
        ]);
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function all(Request $request): AnonymousResourceCollection
    {
        $data = $this->datasetRepository->findBy(
            $request->all(),
            $request->get('ordering_column', 'id'),
            $request->get('ordering_sort', 'DESC'),
            $request->get('pagination', 20)
        );

        return DatasetResource::collection($data);
    }

    /**
     * @param DatasetRequest $request
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function create(DatasetRequest $request): Application|Factory|View|RedirectResponse
    {
        if ($request->isMethod('POST')) {
            $this->datasetService->save($request->all());

            return redirect()->route('inspector.datasets.index')
                ->with('notification.success', 'inspector.notifications.created');
        }

        return view('inspector.datasets.form', [
            'item' => new Dataset(),
            'title' => __('inspector.datasets.form.create.title'),
            'types' => $this->typeRepository->findAll(Dataset::$resourceType),
            'statuses' => $this->statusRepository->findAll(Dataset::$resourceType),
            'processingAreas' => $this->processingAreaRepository->findBy([]),
            'systemsIt' => $this->systemItRepository->findBy([]),
            'resources' => $this->resourceRepository->findBy([]),
            'basicLaw' => $this->lawBasicRepository->findBy([]),
            'types2' => [],
            'categoriesPeople' => []
        ]);
    }

    /**
     * @param DatasetRequest $request
     * @param int $id
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function update(DatasetRequest $request, int $id): Application|Factory|View|RedirectResponse
    {
        $item = $this->datasetRepository->find($id);
        if (!$item) {
            return $this->noItem();
        }

        if ($request->isMethod('POST')) {
            $this->datasetService->save($request->all(), $item);

            return redirect()->route('inspector.datasets.index')
                ->with('notification.success', 'inspector.notifications.updated');
        }

        return view('inspector.datasets.form', [
            'item' => $item,
            'title' => __('inspector.datasets.form.edit.title'),
            'types' => $this->typeRepository->findAll(Dataset::$resourceType),
            'statuses' => $this->statusRepository->findAll(Dataset::$resourceType),
            'processingAreas' => $this->processingAreaRepository->findBy([]),
            'systemsIt' => $this->systemItRepository->findBy([]),
            'resources' => $this->resourceRepository->findBy([]),
            'basicLaw' => $this->lawBasicRepository->findBy([]),
            'types2' => [],
            'categoriesPeople' => []
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function remove(int $id): JsonResponse
    {
        $item = $this->datasetRepository->find($id);
        if (!$item) {
            return $this->itemNoExist();
        }

        $this->datasetService->remove($item);

        return $this->successRemoved();
    }
}
