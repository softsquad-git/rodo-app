<?php

namespace App\Http\Controllers\Inspector\Trainings;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Trainings\AssignGroupDepartmentRequest;
use App\Http\Resources\Trainings\TrainingGroupResource;
use App\Repositories\Trainings\TrainingGroupRepository;
use App\Services\Trainings\TrainingGroupService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class TrainingsController extends ApiController
{
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
        return view('inspector.trainings.index', [
            'title' => __('inspector.trainings.title')
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
     * @param AssignGroupDepartmentRequest $request
     * @param int $groupId
     * @return JsonResponse
     */
    public function assignGroupDepartment(AssignGroupDepartmentRequest $request, int $groupId): JsonResponse
    {
        $group = $this->trainingGroupRepository->find($groupId);
        if (!$group) {
            return $this->itemNoExist();
        }

        $this->trainingGroupService->assignGroupDepartment($request->all(), $group);

        return $this->createdResponse();
    }
}
