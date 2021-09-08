<?php

namespace App\Http\Controllers\Admin\Clients;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clients\ClientRequest;
use App\Models\Clients\Client;
use App\Repositories\Clients\ClientRepository;
use App\Repositories\Settings\StatusRepository;
use App\Repositories\Settings\TypeRepository;
use App\Services\Clients\ClientService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Exception;

class ClientController extends Controller
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
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request): Application|Factory|View
    {
        $data = $this->clientRepository->findBy(
            $request->all(),
            $request->get('ordering_column', 'id'),
            $request->get('ordering_sort', 'DESC'),
            $request->get('pagination', 20)
        );

        return view('admin.clients.index', [
            'title' => __('admin.clients.index'),
            'data' => $data
        ]);
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
            'statuses' => $this->statusRepository->findAll()
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
     * @return RedirectResponse
     */
    public function remove(int $id): RedirectResponse
    {
        /**
         * @var Client $item
         */
        $item = $this->objectNoExist($this->clientRepository->find($id));

        $this->clientService->remove($item);

        return redirect()->back()
            ->with('notification.success', __('notifications.success.removed'));
    }
}
