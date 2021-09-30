<?php

namespace App\Http\Controllers\Inspector\RCP;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Requests\RCP\LawBasicRequest;
use App\Http\Resources\RCP\LawBasicResource;
use App\Models\RCP\LawBasic;
use App\Repositories\RCP\LawBasicRepository;
use App\Repositories\Settings\StatusRepository;
use App\Services\RCP\LawBasicService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class LawBasicController extends ApiController
{
    /**
     * @param LawBasicRepository $lawBasicRepository
     * @param LawBasicService $lawBasicService
     * @param StatusRepository $statusRepository
     */
    public function __construct(
        private LawBasicRepository $lawBasicRepository,
        private LawBasicService $lawBasicService,
        private StatusRepository $statusRepository
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function __invoke(): Application|Factory|View
    {
        return view('inspector.rcp.law_basic.index', [
            'title' => __('inspector.rcp.law_basic.title')
        ]);
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function all(Request $request): AnonymousResourceCollection
    {
        $data = $this->lawBasicRepository->findBy(
            $request->all(),
            $request->get('ordering_column', 'id'),
            $request->get('ordering_sort', 'DESC'),
            $request->get('pagination', 20)
        );

        return LawBasicResource::collection($data);
    }

    /**
     * @param LawBasicRequest $request
     * @return Application|Factory|View|RedirectResponse
     */
    public function create(LawBasicRequest $request): Application|Factory|View|RedirectResponse
    {
        if ($request->isMethod('POST')) {
            $this->lawBasicService->save($request->all());

            return redirect()->route('inspector.rcp.law_basic.index')
                ->with('notification.success', 'inspector.notifications.created');
        }

        return view('inspector.rcp.law_basic.form', [
            'item' => new LawBasic(),
            'statuses' => $this->statusRepository->findAll(LawBasic::$resourceType),
            'title' => __('inspector.rcp.law_basic.form.create.title')
        ]);
    }

    /**
     * @param LawBasicRequest $request
     * @param int $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function update(LawBasicRequest $request, int $id): Application|Factory|View|RedirectResponse
    {
        $item = $this->lawBasicRepository->find($id);
        if (!$item) {
            return $this->noItem();
        }

        if ($request->isMethod('POST')) {
            $this->lawBasicService->save($request->all(), $item);

            return redirect()->route('inspector.rcp.law_basic.index')
                ->with('notification.success', 'inspector.notifications.updated');
        }

        return view('inspector.rcp.law_basic.form', [
            'item' => $item,
            'statuses' => $this->statusRepository->findAll(LawBasic::$resourceType),
            'title' => __('inspector.rcp.law_basic.form.edit.title')
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function remove(int $id): JsonResponse
    {
        $item = $this->lawBasicRepository->find($id);
        if (!$item) {
            return $this->itemNoExist();
        }

        $this->lawBasicService->remove($item);

        return $this->successRemoved();
    }
}
