<?php

namespace App\Http\Controllers\Inspector\RCP;

use App\Http\Controllers\ApiController;
use App\Repositories\Datasets\DatasetRepository;
use Illuminate\Contracts\View\View;
use App\Http\Requests\RCP\RCPActivityRequest;
use App\Http\Resources\RCP\RCPActivityResource;
use App\Models\RCP\RCPActivity;
use App\Repositories\RCP\RCPActivityRepository;
use App\Repositories\Settings\StatusRepository;
use App\Services\RCP\RCPActivityService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\RedirectResponse;

class RCPActivityController extends ApiController
{
    /**
     * @param RCPActivityRepository $RCPActivityRepository
     * @param RCPActivityService $RCPActivityService
     * @param StatusRepository $statusRepository
     * @param DatasetRepository $datasetRepository
     */
    public function __construct(
        private RCPActivityRepository $RCPActivityRepository,
        private RCPActivityService    $RCPActivityService,
        private StatusRepository      $statusRepository,
        private DatasetRepository     $datasetRepository
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function __invoke(): Application|Factory|View
    {
        return view('inspector.rcp.activity.index', [
            'title' => __('inspector.rcp.activity.title')
        ]);
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function all(Request $request): AnonymousResourceCollection
    {
        $data = $this->RCPActivityRepository->findBy(
            $request->all(),
            $request->get('ordering_column', 'id'),
            $request->get('ordering_sort', 'DESC'),
            $request->get('pagination', 20)
        );

        return RCPActivityResource::collection($data);
    }

    /**
     * @param RCPActivityRequest $request
     * @return Application|Factory|View|RedirectResponse
     */
    public function create(RCPActivityRequest $request): Application|Factory|View|RedirectResponse
    {
        if ($request->isMethod('POST')) {
            $this->RCPActivityService->save($request->all());

            return redirect()->route('inspector.rcp.activity.index')
                ->with('notification.success', 'inspector.notifications.created');
        }

        return view('inspector.rcp.activity.form', [
            'item' => new RCPActivity(),
            'title' => __('inspector.rcp.activity.form.create.title'),
            'statuses' => $this->statusRepository->findAll(RCPActivity::$resourceType),
            'datasets' => $this->datasetRepository->findBy()
        ]);
    }

    /**
     * @param RCPActivityRequest $request
     * @param int $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function update(RCPActivityRequest $request, int $id): Application|Factory|View|RedirectResponse
    {
        $item = $this->RCPActivityRepository->find($id);
        if (!$item) {
            return $this->noItem();
        }

        if ($request->isMethod('POST')) {
            $this->RCPActivityService->save($request->all(), $item);

            return redirect()->route('inspector.rcp.activity.index')
                ->with('notification.success', 'inspector.notifications.updated');
        }

        return view('inspector.rcp.activity.form', [
            'item' => $item,
            'title' => __('inspector.rcp.activity.form.edit.title'),
            'statuses' => $this->statusRepository->findAll(RCPActivity::$resourceType),
            'datasets' => $this->datasetRepository->findBy()
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function remove(int $id): JsonResponse
    {
        $item = $this->RCPActivityRepository->find($id);
        if (!$item) {
            return $this->itemNoExist();
        }

        $this->RCPActivityService->remove($item);

        return $this->successRemoved();
    }
}
