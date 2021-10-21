<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Resources\StatusResource;
use App\Repositories\Employees\EmployeeCertificateRepository;
use App\Repositories\Settings\StatusRepository;
use App\Repositories\Tasks\TaskRepository;
use App\Repositories\Trainings\Tests\TestRepository;
use App\Repositories\Trainings\TrainingRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function __construct(
        private StatusRepository $statusRepository,
        private TaskRepository $taskRepository,
        private EmployeeCertificateRepository $employeeCertificateRepository,
        private TestRepository $testRepository,
        private TrainingRepository $trainingRepository
    )
    {
    }

    public function __invoke()
    {
        $tasks = $this->taskRepository->findBy([
            'user_id' => Auth::id()
        ]);
        $certificatesCount = $this->employeeCertificateRepository
            ->findBy([
                'employee_id' => Auth::user()->employee->id,
                'is_all' => true
            ])->count();
        $testsCount = $this->testRepository
            ->findBy([
                'employee_id' => Auth::id(),
                'is_all' => true
            ])->count();
        $trainingsCount = $this->trainingRepository
            ->findBy([
                'employee_id' => Auth::id(),
                'is_all' => true
            ])->count();

        return view('employee.index', [
            'title' => __('employee.title'),
            'tasks' => $tasks,
            'certificatesCount' => $certificatesCount,
            'testsCount' => $testsCount,
            'trainingsCount' => $trainingsCount
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
