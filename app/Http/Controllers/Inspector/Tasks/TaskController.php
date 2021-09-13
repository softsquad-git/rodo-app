<?php

namespace App\Http\Controllers\Inspector\Tasks;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Tasks\TaskRequest;
use App\Http\Resources\Tasks\TaskResource;
use App\Models\Tasks\Task;
use App\Repositories\Settings\StatusRepository;
use App\Repositories\Tasks\TaskRepository;
use App\Services\Tasks\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Exception;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TaskController extends ApiController
{
    public function __construct(
        private TaskRepository $taskRepository,
        private TaskService $taskService,
        private StatusRepository $statusRepository
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function __invoke(): Application|Factory|View
    {
        return view('inspector.tasks.index', [
            'title' => __('inspector.tasks.title')
        ]);
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function all(Request $request): AnonymousResourceCollection
    {
        $data = $this->taskRepository->findBy(
            $request->all(),
            $request->get('ordering_column', 'id'),
            $request->get('ordering_sort', 'DESC'),
            $request->get('pagination', 20)
        );

        return TaskResource::collection($data);
    }

    /**
     * @param TaskRequest $request
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function create(TaskRequest $request): Application|Factory|View|RedirectResponse
    {
        if ($request->isMethod('POST')) {
            $this->taskService->save($request->all());

            return redirect()->route('inspector.tasks.index')
                ->with('');
        }

        return \view('inspector.tasks.form', [
            'title' => __('inspector.tasks.form.create.title'),
            'item' => new Task(),
            'statuses' => $this->statusRepository->findAll(Task::$resourceType)
        ]);
    }

    /**
     * @param TaskRequest $request
     * @param int $id
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function update(TaskRequest $request, int $id): Application|Factory|View|RedirectResponse
    {
        /**
         * @var Task $item
         */
        $item = $this->objectNoExist($this->taskRepository->find($id));
        if ($request->isMethod('POST')) {
            $this->taskService->save($request->all(), $item);

            return redirect()->route('inspector.tasks.index')
                ->with('');
        }

        return \view('inspector.tasks.form', [
            'title' => __('inspector.tasks.form.create.title'),
            'item' => $item,
            'statuses' => $this->statusRepository->findAll(Task::$resourceType)
        ]);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function remove($id): JsonResponse
    {
        /**
         * @var Task $item
         */
        $item = $this->taskRepository->find($id);

        if (!$item) {
            return $this->itemNoExist();
        }

        $this->taskService->remove($item);

        return $this->successRemoved();
    }
}
