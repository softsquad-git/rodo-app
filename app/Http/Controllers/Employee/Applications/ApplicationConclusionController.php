<?php

namespace App\Http\Controllers\Employee\Applications;

use App\Http\Controllers\Controller;
use App\Http\Resources\Applications\ApplicationConclusionsResource;
use App\Repositories\Applications\ApplicationConclusionRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Auth;

class ApplicationConclusionController extends Controller
{
    /**
     * @param ApplicationConclusionRepository $applicationConclusionRepository
     */
    public function __construct(
        private ApplicationConclusionRepository $applicationConclusionRepository
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function __invoke(): Application|Factory|View
    {
        return view('employee.applications.conclusions.index', [
            'title' => __('employee.applications.conclusions.title')
        ]);
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function all(Request $request): AnonymousResourceCollection
    {
        $filters = $request->all();
        $filters['accepted_employee_id'] = Auth::id();

        $data = $this->applicationConclusionRepository->findBy(
            $filters,
            $request->get('ordering_column', 'id'),
            $request->get('ordering_sort', 'DESC'),
            $request->get('pagination', 20)
        );

        return ApplicationConclusionsResource::collection($data);
    }
}
