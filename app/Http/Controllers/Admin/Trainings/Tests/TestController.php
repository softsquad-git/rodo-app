<?php

namespace App\Http\Controllers\Admin\Trainings\Tests;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Tests\TestRequest;
use App\Http\Resources\Trainings\Tests\TestsResource;
use App\Models\Tests\Test;
use App\Repositories\Trainings\Tests\TestQuestionRepository;
use App\Repositories\Trainings\Tests\TestRepository;
use App\Repositories\Trainings\TrainingGroupRepository;
use App\Services\Tests\TestService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\RedirectResponse;
use Exception;

class TestController extends ApiController
{
    /**
     * @param TestQuestionRepository $testQuestionRepository
     * @param TestRepository $testRepository
     * @param TestService $testService
     * @param TrainingGroupRepository $trainingGroupRepository
     */
    public function __construct(
        private TestQuestionRepository $testQuestionRepository,
        private TestRepository $testRepository,
        private TestService $testService,
        private TrainingGroupRepository $trainingGroupRepository
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function __invoke(): Application|Factory|View
    {
        return view('admin.trainings.tests.index', [
            'title' => __('admin.trainings.tests.title')
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
            $request->get('ordering_sort', 'desc'),
            $request->get('pagination', 20)
        );

        return TestsResource::collection($data);
    }

    /**
     * @param TestRequest $request
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function create(TestRequest $request): Application|Factory|View|RedirectResponse
    {
        if ($request->isMethod('POST')) {
            $this->testService->save($request->all());

            return redirect()->route('admin.trainings.tests.index')
                ->with('notification.success', __('admin.notifications.created'));
        }

        return view('admin.trainings.tests.form', [
            'title' => __('admin.trainings.tests.form.create.title'),
            'item' => new Test(),
            'questions' => $this->testQuestionRepository->findAll(),
            'groups' => $this->trainingGroupRepository->findAll()
        ]);
    }

    /**
     * @param TestRequest $request
     * @param int $id
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function update(TestRequest $request, int $id): Application|Factory|View|RedirectResponse
    {
        /**
         * @var Test $item
         */
        $item = $this->objectNoExist($this->testRepository->find($id));

        if ($request->isMethod('POST')) {
            $this->testService->save($request->all(), $item);

            return redirect()->route('admin.trainings.tests.index')
                ->with('notification.success', __('admin.notifications.updated'));
        }

        return view('admin.trainings.tests.form', [
            'title' => __('admin.trainings.tests.form.edit.title'),
            'item' => $item,
            'questions' => $this->testQuestionRepository->findAll(),
            'groups' => $this->trainingGroupRepository->findAll()
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function remove(int $id): JsonResponse
    {
        /**
         * @var Test $item
         */
        $item = $this->testRepository->find($id);

        if (!$item) {
            return $this->itemNoExist();
        }

        $this->testService->remove($item);

        return $this->successRemoved();
    }
}
