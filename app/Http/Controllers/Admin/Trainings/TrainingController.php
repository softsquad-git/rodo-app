<?php

namespace App\Http\Controllers\Admin\Trainings;

use App\Http\Controllers\ApiController;
use App\Repositories\Settings\StatusRepository;
use App\Repositories\Trainings\TrainingGroupRepository;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Trainings\TrainingRequest;
use App\Http\Resources\Trainings\TrainingResource;
use App\Models\Trainings\Training;
use App\Repositories\Trainings\TrainingRepository;
use App\Services\Trainings\TrainingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Exception;

class TrainingController extends ApiController
{
    public function __construct(
        private TrainingRepository $trainingRepository,
        private TrainingService    $trainingService,
        private TrainingGroupRepository $trainingGroupRepository,
        private StatusRepository $statusRepository
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function __invoke(): Application|Factory|View
    {
        return view('admin.trainings.index', [
            'title' => __('admin.trainings.title')
        ]);
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function all(Request $request): AnonymousResourceCollection
    {
        $data = $this->trainingRepository->findBy(
            $request->all(),
            $request->get('ordering_column', 'id'),
            $request->get('ordering_sort', 'DESC'),
            $request->get('pagination', 20)
        );

        return TrainingResource::collection($data);
    }

    /**
     * @param TrainingRequest $request
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function create(TrainingRequest $request): Application|Factory|View|RedirectResponse
    {
        if ($request->isMethod('POST')) {
            $this->trainingService->save($request->all());

            return redirect()->route('admin.trainings.index')
                ->with('notification.success', __('admin.notifications.created'));
        }

        return view('admin.trainings.form', [
            'title' => __('admin.trainings.form.create.title'),
            'item' => new Training(),
            'groups' => $this->trainingGroupRepository->findAll(),
            'statuses' => $this->statusRepository->findAll(Training::$resourceType)
        ]);
    }

    /**
     * @param TrainingRequest $request
     * @param int $id
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function update(TrainingRequest $request, int $id): Application|Factory|View|RedirectResponse
    {
        /**
         * @var Training $item
         */
        $item = $this->objectNoExist($this->trainingRepository->find($id));

        if ($request->isMethod('POST')) {
            $this->trainingService->save($request->all(), $item);

            return redirect()->route('admin.trainings.index')
                ->with('notification.success', __('admin.notifications.updated'));
        }

        return view('admin.trainings.form', [
            'title' => __('admin.trainings.form.create.title'),
            'item' => $item,
            'groups' => $this->trainingGroupRepository->findAll(),
            'statuses' => $this->statusRepository->findAll(Training::$resourceType)
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function remove(int $id): JsonResponse
    {
        /**
         * @var Training $item
         */
        $item = $this->trainingRepository->find($id);

        if (!$item) {
            return $this->itemNoExist();
        }

        $this->trainingService->remove($item);

        return $this->successRemoved();
    }
}
