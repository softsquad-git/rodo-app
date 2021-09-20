<?php

namespace App\Http\Controllers\Admin\Trainings\Tests;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Tests\TestQuestionRequest;
use App\Http\Resources\Trainings\Tests\TestQuestionsResource;
use App\Models\Tests\TestQuestion;
use App\Repositories\Trainings\Tests\TestQuestionRepository;
use App\Services\Tests\TestQuestionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class TestQuestionController extends ApiController
{
    /**
     * @param TestQuestionRepository $testQuestionRepository
     * @param TestQuestionService $testQuestionService
     */
    public function __construct(
        private TestQuestionRepository $testQuestionRepository,
        private TestQuestionService    $testQuestionService
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function __invoke(): Application|Factory|View
    {
        return view('admin.trainings.tests.questions.index', [
            'title' => __('admin.trainings.tests.questions.title')
        ]);
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function all(Request $request): AnonymousResourceCollection
    {
        $data = $this->testQuestionRepository->findBy(
            $request->all(),
            $request->get('ordering_column', 'id'),
            $request->get('ordering_sort', 'desc'),
            $request->get('pagination', 20)
        );

        return TestQuestionsResource::collection($data);
    }

    /**
     * @param int $id
     * @return TestQuestionsResource|JsonResponse
     */
    public function find(int $id): TestQuestionsResource|JsonResponse
    {
        $item = $this->testQuestionRepository->find($id);
        if (!$item) {
            return $this->itemNoExist();
        }

        return new TestQuestionsResource($item);
    }

    /**
     * @param TestQuestionRequest $request
     * @return Application|Factory|View|JsonResponse
     * @throws Exception
     */
    public function create(TestQuestionRequest $request): Application|Factory|View|JsonResponse
    {
        if ($request->isMethod('POST')) {
            $data = $request->all();
            $this->testQuestionService->save($data);

            return $this->createdResponse();
        }

        return view('admin.trainings.tests.questions.form', [
            'title' => __('admin.trainings.tests.questions.form.create.title'),
            'item' => new TestQuestion()
        ]);
    }

    /**
     * @param TestQuestionRequest $request
     * @param int $id
     * @return Application|Factory|View|JsonResponse
     * @throws Exception
     */
    public function update(TestQuestionRequest $request, int $id): Application|Factory|View|JsonResponse
    {
        $item = $this->testQuestionRepository->find($id);
        if ($request->isMethod('POST')) {
            if (!$item) {
                return $this->itemNoExist();
            }

            $this->testQuestionService->save($request->all(), $item);

            return $this->createdResponse();
        }

        return view('admin.trainings.tests.questions.form', [
            'title' => __('admin.trainings.tests.questions.form.create.title'),
            'item' => $item
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function remove(int $id): JsonResponse
    {
        $item = $this->testQuestionRepository->find($id);
        if (!$item) {
            return $this->itemNoExist();
        }

        $this->testQuestionService->remove($item);

        return $this->successRemoved();
    }
}
