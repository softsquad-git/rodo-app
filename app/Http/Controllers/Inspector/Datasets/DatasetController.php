<?php

namespace App\Http\Controllers\Inspector\Datasets;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Datasets\DatasetRequest;
use App\Http\Resources\Datasets\DatasetResource;
use App\Models\DataSets\Dataset;
use App\Repositories\Datasets\DatasetRepository;
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
    /**
     * @param DatasetRepository $datasetRepository
     * @param DatasetService $datasetService
     */
    public function __construct(
        private DatasetRepository $datasetRepository,
        private DatasetService    $datasetService
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
     * @return Application|Factory|View|JsonResponse
     * @throws Exception
     */
    public function create(DatasetRequest $request): Application|Factory|View|JsonResponse
    {
        if ($request->isMethod('POST')) {
            $this->datasetService->save($request->all());

            return $this->createdResponse();
        }

        return view('inspector.datasets.form', [
            'item' => new Dataset(),
            'title' => __('inspector.datasets.form.create.title')
        ]);
    }

    /**
     * @param DatasetRequest $request
     * @param int $id
     * @return Application|Factory|View|JsonResponse|RedirectResponse
     * @throws Exception
     */
    public function update(DatasetRequest $request, int $id): Application|Factory|View|JsonResponse|RedirectResponse
    {
        $item = $this->datasetRepository->find($id);
        if (!$item) {
            return $this->noItem();
        }

        if ($request->isMethod('POST')) {
            $this->datasetService->save($request->all(), $item);

            return $this->updatedResponse();
        }

        return view('inspector.datasets.form', [
            'item' => $item,
            'title' => __('inspector.datasets.form.edit.title')
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
