<?php

namespace App\Http\Controllers\Inspector\Assets;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Assets\ResourceRequest;
use App\Http\Resources\Assets\ResourcesResource;
use App\Models\Assets\Resource;
use App\Models\RiskAnalysis\Security;
use App\Repositories\Assets\ResourceRepository;
use App\Repositories\RiskAnalysis\SecurityRepository;
use App\Repositories\Settings\StatusRepository;
use App\Repositories\Settings\TypeRepository;
use App\Services\Assets\ResourceService;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Exception;

class ResourcesController extends ApiController
{
    /**
     * @param StatusRepository $statusRepository
     * @param TypeRepository $typeRepository
     * @param ResourceRepository $resourceRepository
     * @param ResourceService $resourceService
     * @param SecurityRepository $securityRepository
     */
    public function __construct(
        private StatusRepository   $statusRepository,
        private TypeRepository     $typeRepository,
        private ResourceRepository $resourceRepository,
        private ResourceService    $resourceService,
        private SecurityRepository $securityRepository
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function __invoke(): Application|Factory|View
    {
        return view('inspector.assets.resources.index', [
            'title' => __('inspector.assets.resources.title')
        ]);
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function all(Request $request): AnonymousResourceCollection
    {
        $data = $this->resourceRepository->findBy(
            $request->all(),
            $request->get('ordering_column', 'id'),
            $request->get('ordering_sort', 'DESC'),
            $request->get('pagination', 20)
        );

        return ResourcesResource::collection($data);
    }

    /**
     * @param ResourceRequest $request
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function create(ResourceRequest $request): Application|Factory|View|RedirectResponse
    {
        if ($request->isMethod('POST')) {
            $this->resourceService->save($request->all());

            return redirect()->route('inspector.assets.resources.index')
                ->with('notification.success', 'inspector.notifications.created');
        }

        return view('inspector.assets.resources.form', [
            'title' => __('inspector.assets.resources.form.create.title'),
            'item' => new Resource(),
            'statuses' => $this->statusRepository->findAll(Resource::$resourceType),
            'types' => $this->typeRepository->findAll(Resource::$resourceType),
            'security' => $this->securityRepository->findBy(['type' => Security::$types['technical']])
        ]);
    }

    /**
     * @param ResourceRequest $request
     * @param int $id
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function update(ResourceRequest $request, int $id): Application|Factory|View|RedirectResponse
    {
        $item = $this->resourceRepository->find($id);
        if (!$item) {
            return $this->noItem();
        }

        if ($request->isMethod('POST')) {
            $this->resourceService->save($request->all(), $item);

            return redirect()->route('inspector.assets.resources.index')
                ->with('notification.success', 'inspector.notifications.updated');
        }

        return view('inspector.assets.resources.form', [
            'title' => __('inspector.assets.resources.form.edit.title'),
            'item' => $item,
            'statuses' => $this->statusRepository->findAll(Resource::$resourceType),
            'types' => $this->typeRepository->findAll(Resource::$resourceType),
            'security' => $this->securityRepository->findBy(['type' => Security::$types['technical']])
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function remove(int $id): JsonResponse
    {
        $item = $this->resourceRepository->find($id);
        if (!$item) {
            return $this->itemNoExist();
        }

        $this->resourceService->remove($item);

        return $this->successRemoved();
    }
}
