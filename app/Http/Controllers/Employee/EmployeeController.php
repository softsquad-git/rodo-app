<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Resources\StatusResource;
use App\Repositories\Settings\StatusRepository;
use App\Repositories\Tasks\TaskRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function __construct(
        private StatusRepository $statusRepository,
        private TaskRepository $taskRepository
    )
    {
    }

    public function __invoke()
    {
        $tasks = $this->taskRepository->findBy([
            'user_id' => Auth::id()
        ]);

        return view('employee.index', [
            'title' => __('employee.title'),
            'tasks' => $tasks
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
