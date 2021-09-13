<?php

namespace App\Http\Controllers\Admin\Trainings;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Trainings\TrainingGroupRequest;
use App\Http\Resources\Trainings\TrainingGroupResource;
use App\Models\Trainings\TrainingGroup;
use App\Repositories\Trainings\TrainingGroupRepository;
use App\Services\Trainings\TrainingGroupService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\RedirectResponse;

class TrainingGroupController extends ApiController
{
    /**
     * @param TrainingGroupRepository $trainingGroupRepository
     * @param TrainingGroupService $trainingGroupService
     */
    public function __construct(
        private TrainingGroupRepository $trainingGroupRepository,
        private TrainingGroupService $trainingGroupService
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function __invoke(): Application|Factory|View
    {
        return view('admin.trainings.groups.index', [
            'title' => __('admin.trainings.groups.title')
        ]);
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function all(Request $request): AnonymousResourceCollection
    {
        $data = $this->trainingGroupRepository->findBy(
            $request->all(),
            $request->get('ordering_column', 'id'),
            $request->get('ordering_sort', 'DESC'),
            $request->get('pagination', 20)
        );

        return TrainingGroupResource::collection($data);
    }

    /**
     * @param TrainingGroupRequest $request
     * @return Application|Factory|View|RedirectResponse
     */
    public function create(TrainingGroupRequest $request): Application|Factory|View|RedirectResponse
    {
        if ($request->isMethod('POST')) {
            $this->trainingGroupService->save($request->all());

            return redirect()->route('admin.trainings.groups.index')
                ->with('notification.success', __('admin.notifications.created'));
        }

        return view('admin.trainings.groups.form', [
            'title' => __('admin.trainings.groups.form.create.title'),
            'item' => new TrainingGroup()
        ]);
    }

    /**
     * @param TrainingGroupRequest $request
     * @param int $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function update(TrainingGroupRequest $request, int $id): Application|Factory|View|RedirectResponse
    {
        /**
         * @var TrainingGroup $item
         */
        $item = $this->objectNoExist($this->trainingGroupRepository->find($id));

        if ($request->isMethod('POST')) {
            $this->trainingGroupService->save($request->all(), $item);

            return redirect()->route('admin.trainings.groups.index')
                ->with('notification.success', __('admin.notifications.updated'));
        }

        return view('admin.trainings.groups.form', [
            'title' => __('admin.trainings.groups.form.edit.title'),
            'item' => $item
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function remove(int $id): JsonResponse
    {
        $item = $this->trainingGroupRepository->find($id);

        if (!$item) {
            return $this->itemNoExist();
        }

        $this->trainingGroupService->remove($item);

        return $this->successRemoved();
    }
}
