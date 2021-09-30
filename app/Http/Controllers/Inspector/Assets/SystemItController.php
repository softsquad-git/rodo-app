<?php

namespace App\Http\Controllers\Inspector\Assets;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Assets\SystemItRequest;
use App\Http\Resources\Assets\SystemItResource;
use App\Models\Assets\SystemIt;
use App\Repositories\Assets\SystemItRepository;
use App\Repositories\Settings\StatusRepository;
use App\Repositories\Settings\TypeRepository;
use App\Services\Assets\SystemItService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\RedirectResponse;

class SystemItController extends ApiController
{
    /**
     * @param SystemItRepository $systemItRepository
     * @param SystemItService $systemItService
     * @param StatusRepository $statusRepository
     * @param TypeRepository $typeRepository
     */
    public function __construct(
        private SystemItRepository $systemItRepository,
        private SystemItService    $systemItService,
        private StatusRepository   $statusRepository,
        private TypeRepository     $typeRepository
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function __invoke(): Application|Factory|View
    {
        return view('inspector.assets.system_it.index', [
            'title' => __('inspector.assets.system_it.title')
        ]);
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function all(Request $request): AnonymousResourceCollection
    {
        $data = $this->systemItRepository->findBy(
            $request->all(),
            $request->get('ordering_column', 'id'),
            $request->get('ordering_sort', 'DESC'),
            $request->get('pagination', 20)
        );

        return SystemItResource::collection($data);
    }

    /**
     * @param SystemItRequest $request
     * @return Application|Factory|View|RedirectResponse
     */
    public function create(SystemItRequest $request): Application|Factory|View|RedirectResponse
    {
        if ($request->isMethod('POST')) {
            $this->systemItService->save($request->all());

            return redirect()->route('inspector.assets.system_it.index')
                ->with('notification.success', 'inspector.notifications.created');
        }

        return view('inspector.assets.system_it.form', [
            'title' => __('inspector.assets.system_it.form.create.title'),
            'item' => new SystemIt(),
            'statuses' => $this->statusRepository->findAll(SystemIt::$resourceType),
            'types' => $this->typeRepository->findAll(SystemIt::$resourceType)
        ]);
    }

    /**
     * @param SystemItRequest $request
     * @param int $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function update(SystemItRequest $request, int $id): Application|Factory|View|RedirectResponse
    {
        $item = $this->systemItRepository->find($id);
        if (!$item) {
            return $this->noItem();
        }

        if ($request->isMethod('POST')) {
            $this->systemItService->save($request->all(), $item);

            return redirect()->route('inspector.assets.system_it.index')
                ->with('notification.success', 'inspector.notifications.updated');
        }

        return view('inspector.assets.system_it.form', [
            'title' => __('inspector.assets.system_it.form.edit.title'),
            'item' => $item,
            'statuses' => $this->statusRepository->findAll(SystemIt::$resourceType),
            'types' => $this->typeRepository->findAll(SystemIt::$resourceType)
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function remove(int $id): JsonResponse
    {
        $item = $this->systemItRepository->find($id);
        if (!$item) {
            return $this->itemNoExist();
        }

        $this->systemItService->remove($item);

        return $this->successRemoved();
    }
}
