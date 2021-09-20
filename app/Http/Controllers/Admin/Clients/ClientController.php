<?php

namespace App\Http\Controllers\Admin\Clients;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Clients\ClientRequest;
use App\Http\Resources\Clients\ClientsResource;
use App\Models\Clients\Client;
use App\Repositories\Clients\ClientRepository;
use App\Repositories\Settings\StatusRepository;
use App\Repositories\Settings\TypeRepository;
use App\Services\Clients\ClientService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Exception;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ClientController extends ApiController
{
    public function __construct(
        private ClientRepository $clientRepository,
        private ClientService $clientService,
        private TypeRepository $typeRepository,
        private StatusRepository $statusRepository
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function __invoke(): Application|Factory|View
    {
        return view('admin.clients.index', [
            'title' => __('admin.clients.index')
        ]);
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function all(Request $request): AnonymousResourceCollection
    {
        $data = $this->clientRepository->findBy(
            $request->all(),
            $request->get('ordering_column', 'id'),
            $request->get('ordering_sort', 'DESC'),
            $request->get('pagination', 20)
        );

        return ClientsResource::collection($data);
    }

    /**
     * @param ClientRequest $request
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function create(ClientRequest $request): Application|Factory|View|RedirectResponse
    {
        if ($request->isMethod('POST')) {
            $this->clientService->save($request->all());

            return redirect()->route('admin.clients.index')
                ->with('notification.success', __('notifications.success.created'));
        }

        return \view('admin.clients.form', [
            'item' => new Client(),
            'title' => __('admin.clients.form.create.title'),
            'types' => $this->typeRepository->findBy(['resource_type' => Client::$resourceType]),
            'statuses' => $this->statusRepository->findAll(Client::$resourceType)
        ]);
    }

    /**
     * @param ClientRequest $request
     * @param int $id
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function update(ClientRequest $request, int $id): Application|Factory|View|RedirectResponse
    {
        /**
         * @var Client $item
         */
        $item = $this->objectNoExist($this->clientRepository->find($id));

        if ($request->isMethod('POST')) {
            $this->clientService->save($request->all(), $item);

            return redirect()->route('admin.clients.index')
                ->with('notification.success', __('admin.notifications.updated'));
        }

        return \view('admin.clients.form', [
            'item' => $item,
            'title' => __('admin.clients.form.update.title'),
            'types' => $this->typeRepository->findBy(['resource_type' => Client::$resourceType]),
            'statuses' => $this->statusRepository->findAll()
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function remove(int $id): JsonResponse
    {
        /**
         * @var Client $item
         */
        $item = $this->clientRepository->find($id);

        if (!$item) {
            return $this->itemNoExist();
        }

        $this->clientService->remove($item);

        return $this->successRemoved();
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function archive(int $id): JsonResponse
    {
        /**
         * @var Client $item
         */
        $item = $this->clientRepository->find($id);

        if (!$item) {
            return $this->itemNoExist();
        }

        $item->update(['is_archive' => $item->is_archive == 1 ? 0 : 1]);

        return $this->successResponse();
    }
}
