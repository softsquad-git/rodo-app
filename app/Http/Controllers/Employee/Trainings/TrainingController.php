<?php

namespace App\Http\Controllers\Employee\Trainings;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Trainings\TrainingGroupResource;
use App\Repositories\Trainings\TrainingGroupRepository;
use App\Repositories\Trainings\TrainingRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class TrainingController extends ApiController
{
    public function __construct(
        private TrainingGroupRepository $trainingGroupRepository,
        private TrainingRepository      $trainingRepository
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function __invoke(): Application|Factory|View
    {
        return view('employee.trainings.index', [
            'title' => __('employee.trainings.title')
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
        $training = $this->trainingRepository->find($id);
        if (!$training) {
            return $this->itemNoExist();
        }

        return view('employee.trainings.show', [
            'training' => $training,
            'title' => $training->name
        ]);
    }

    /**
     * @param int $id
     * @return Application|Factory|View|JsonResponse
     */
    public function browser(int $id): Application|Factory|View|JsonResponse
    {
        $training = $this->trainingRepository->find($id);
        if (!$training) {
            return $this->itemNoExist();
        }

        return view('employee.trainings.browser', [
            'file' => $training->getFile(),
            'title' => $training->name
        ]);
    }
}
