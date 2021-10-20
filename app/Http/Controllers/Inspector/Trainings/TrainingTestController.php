<?php

namespace App\Http\Controllers\Inspector\Trainings;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Tests\AssignTestDepartmentRequest;
use App\Http\Resources\Trainings\Tests\TestsResource;
use App\Services\Tests\TestService;
use Illuminate\Contracts\View\View;
use App\Repositories\Trainings\Tests\TestRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TrainingTestController extends ApiController
{
    public function __construct(
        private TestRepository $testRepository,
        private TestService $testService
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function __invoke(): Application|Factory|View
    {
        return view('inspector.trainings.tests.index', [
            'title' => __('inspector.trainings.tests.title')
        ]);
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function all(Request $request): AnonymousResourceCollection
    {
        $data = $this->testRepository->findBy(
            $request->all(),
            $request->get('ordering_column', 'id'),
            $request->get('ordering_sort', 'DESC'),
            $request->get('pagination', 20)
        );

        return TestsResource::collection($data);
    }

    /**
     * @param AssignTestDepartmentRequest $request
     * @param int $testId
     * @return JsonResponse
     */
    public function assignTestDepartment(AssignTestDepartmentRequest $request, int $testId): JsonResponse
    {
        $test = $this->testRepository->find($testId);
        if (!$test) {
            return $this->itemNoExist();
        }

        $this->testService->assignDepartmentTest($request->all(), $test);

        return $this->createdResponse();
    }
}
