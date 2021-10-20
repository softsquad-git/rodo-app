<?php

namespace App\Http\Controllers\Employee\Applications;

use App\Http\Controllers\Controller;
use App\Http\Resources\Applications\ApplicationIncidentsResource;
use App\Repositories\Applications\ApplicationIncidentRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ApplicationIncidentsController extends Controller
{
    /**
     * @param ApplicationIncidentRepository $applicationIncidentRepository
     */
    public function __construct(
        private ApplicationIncidentRepository $applicationIncidentRepository
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function __invoke(): Application|Factory|View
    {
        return view('employee.applications.incidents.index', [
            'title' => __('employee.applications.incidents.title')
        ]);
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function all(Request $request): AnonymousResourceCollection
    {
        $filters = $request->all();
        $filters['employee_id'] = Auth::id();
        $data = $this->applicationIncidentRepository->findBy(
            $filters,
            $request->get('ordering_column', 'id'),
            $request->get('ordering_sort', 'DESC'),
            $request->get('pagination', 20)
        );

        return ApplicationIncidentsResource::collection($data);
    }
}
