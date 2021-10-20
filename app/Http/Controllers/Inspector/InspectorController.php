<?php

namespace App\Http\Controllers\Inspector;

use App\Http\Controllers\Controller;
use App\Http\Resources\StatusResource;
use App\Repositories\Clients\ClientRepository;
use App\Repositories\Settings\StatusRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class InspectorController extends Controller
{
    public function __construct(
        private StatusRepository $statusRepository,
        private ClientRepository $clientRepository
    )
    {
    }

    /**
     * @param Request $request
     * @return Application|Factory|View|RedirectResponse
     */
    public function __invoke(Request $request): Application|Factory|View|RedirectResponse
    {
        if ($request->isMethod('POST')) {
            $clientId = (int)$request->post('client_id', null);
            if (!$clientId) {
                Session::put('inspector_client_id', null);

                return redirect()->back();
            }

            Session::put('inspector_client_id', $clientId);

            return redirect()->back();
        }

        $clients = $this->clientRepository->findBy(['inspector_id' => Auth::id()]);

        return view('inspector.index', [
            'title' => __('inspector.title'),
            'clients' => $clients
        ]);
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function getStatuses(Request $request): AnonymousResourceCollection
    {
        $data = $this->statusRepository->findAll($request->get('resource_type'));

        return StatusResource::collection($data);
    }
}
