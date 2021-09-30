<?php

namespace App\Http\Controllers\Inspector\RCP;

use App\Http\Controllers\ApiController;
use App\Http\Requests\RCP\RCPDataRetentionRequest;
use App\Http\Resources\RCP\RCPDataRetentionResource;
use App\Models\RCP\RCPDataRetention;
use App\Repositories\RCP\RCPDataRetentionRepository;
use App\Repositories\Settings\StatusRepository;
use App\Services\RCP\RCPDataRetentionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class RCPDataRetentionController extends ApiController
{
    /**
     * @param RCPDataRetentionRepository $RCPDataRetentionRepository
     * @param RCPDataRetentionService $RCPDataRetentionService
     * @param StatusRepository $statusRepository
     */
    public function __construct(
        private RCPDataRetentionRepository $RCPDataRetentionRepository,
        private RCPDataRetentionService    $RCPDataRetentionService,
        private StatusRepository           $statusRepository
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function __invoke(): Application|Factory|View
    {
        return view('inspector.rcp.data_retention.index', [
            'title' => __('inspector.rcp.data_retention.title')
        ]);
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function all(Request $request): AnonymousResourceCollection
    {
        $data = $this->RCPDataRetentionRepository->findBy(
            $request->all(),
            $request->get('ordering_column', 'id'),
            $request->get('ordering_sort', 'DESC'),
            $request->get('pagination', 20)
        );

        return RCPDataRetentionResource::collection($data);
    }

    /**
     * @param RCPDataRetentionRequest $request
     * @return Application|Factory|View|RedirectResponse
     */
    public function create(RCPDataRetentionRequest $request): Application|Factory|View|RedirectResponse
    {
        if ($request->isMethod('POST')) {
            $this->RCPDataRetentionService->save($request->all());

            return redirect()->route('inspector.rcp.data_retention.index')
                ->with('notification.success', 'inspector.notifications.created');
        }

        return view('inspector.rcp.data_retention.form', [
            'item' => new RCPDataRetention(),
            'title' => __('inspector.rcp.data_retention.form.create.title'),
            'statuses' => $this->statusRepository->findAll(RCPDataRetention::$resourceType)
        ]);
    }

    /**
     * @param RCPDataRetentionRequest $request
     * @param int $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function update(RCPDataRetentionRequest $request, int $id): Application|Factory|View|RedirectResponse
    {
        $item = $this->RCPDataRetentionRepository->find($id);
        if (!$item) {
            return $this->noItem();
        }

        if ($request->isMethod('POST')) {
            $this->RCPDataRetentionService->save($request->all(), $item);

            return redirect()->route('inspector.rcp.data_retention.index')
                ->with('notification.success', 'inspector.notifications.updated');
        }

        return view('inspector.rcp.data_retention.form', [
            'item' => $item,
            'title' => __('inspector.rcp.data_retention.form.edit.title'),
            'statuses' => $this->statusRepository->findAll(RCPDataRetention::$resourceType)
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function remove(int $id): JsonResponse
    {
        $item = $this->RCPDataRetentionRepository->find($id);
        if (!$item) {
            return $this->itemNoExist();
        }

        $this->RCPDataRetentionService->remove($item);

        return $this->successRemoved();
    }
}
