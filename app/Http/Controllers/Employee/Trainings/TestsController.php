<?php

namespace App\Http\Controllers\Employee\Trainings;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Employees\EmployeeTestCompleteRequest;
use App\Services\Tests\TestService;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\Trainings\TrainingGroupResource;
use App\Repositories\Trainings\Tests\TestRepository;
use App\Repositories\Trainings\TrainingGroupRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Exception;

class TestsController extends ApiController
{
    public function __construct(
        private TestRepository          $testRepository,
        private TrainingGroupRepository $trainingGroupRepository,
        private TestService             $testService
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function __invoke(): Application|Factory|View
    {
        return view('employee.trainings.tests.index', [
            'title' => __('employee.trainings.tests.title')
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
        $data = $this->trainingGroupRepository->findBy(
            $filters
        );

        return TrainingGroupResource::collection($data);
    }

    /**
     * @param int $id
     * @return Application|Factory|View|JsonResponse
     */
    public function show(int $id): Application|Factory|View|JsonResponse
    {
        $test = $this->testRepository->find($id);
        if (!$test) {
            return $this->itemNoExist();
        }

        return view('employee.trainings.tests.show', [
            'title' => $test->name,
            'test' => $test
        ]);
    }

    /**
     * @param EmployeeTestCompleteRequest $request
     * @param int $testId
     * @return RedirectResponse
     * @throws Exception
     */
    public function completeTest(EmployeeTestCompleteRequest $request, int $testId): RedirectResponse
    {
        $test = $this->testRepository->find($testId);
        if (!$test) {
            return redirect()->back();
        }

        $testComplete = $this->testService->complete($request->all(), $test);

        if ($testComplete === false) {
            return redirect()->route('employee.trainings.tests.index')
                ->with('notifications.error', 'Wynik testu jest negatywny');
        }

        return redirect()->route('employee.trainings.certificates.index')
            ->with('notifications.success', 'Test został zaliczony');
    }
}
