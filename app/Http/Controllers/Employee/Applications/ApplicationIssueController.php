<?php

namespace App\Http\Controllers\Employee\Applications;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Applications\ApplicationIssuesResource;
use App\Repositories\Applications\ApplicationIssueRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class ApplicationIssueController extends ApiController
{
    /**
     * @param ApplicationIssueRepository $applicationIssueRepository
     */
    public function __construct(
        private ApplicationIssueRepository $applicationIssueRepository
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function __invoke(): Application|Factory|View
    {
        return view('employee.applications.issues.index', [
            'title' => __('employee.applications.issues.title')
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
        $data = $this->applicationIssueRepository->findBy(
            $filters,
            $request->get('ordering_column', 'id'),
            $request->get('ordering_sort', 'DESC'),
            $request->get('pagination', 20)
        );

        return ApplicationIssuesResource::collection($data);
    }
}
