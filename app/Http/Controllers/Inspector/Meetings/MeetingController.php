<?php

namespace App\Http\Controllers\Inspector\Meetings;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Meetings\MeetingRequest;
use App\Http\Resources\Employees\EmployeesResource;
use App\Http\Resources\Meetings\MeetingsResource;
use App\Models\Meetings\Meeting;
use App\Repositories\Employees\EmployeeRepository;
use App\Repositories\Meetings\MeetingRepository;
use App\Repositories\Settings\StatusRepository;
use App\Services\Meetings\MeetingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Exception;

class MeetingController extends ApiController
{
    /**
     * @param StatusRepository $statusRepository
     * @param MeetingRepository $meetingRepository
     * @param MeetingService $meetingService
     * @param EmployeeRepository $employeeRepository
     */
    public function __construct(
        private StatusRepository   $statusRepository,
        private MeetingRepository  $meetingRepository,
        private MeetingService     $meetingService,
        private EmployeeRepository $employeeRepository
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function __invoke(): Application|Factory|View
    {
        return view('inspector.meetings.index', [
            'title' => __('inspector.meetings.title')
        ]);
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function all(Request $request): AnonymousResourceCollection
    {
        $data = $this->meetingRepository->findBy(
            $request->all(),
            $request->get('ordering_column', 'id'),
            $request->get('ordering_sort', 'DESC'),
            $request->get('pagination', 20)
        );

        return MeetingsResource::collection($data);
    }

    /**
     * @param MeetingRequest $request
     * @return Application|Factory|View|RedirectResponse|JsonResponse
     * @throws Exception
     */
    public function create(MeetingRequest $request): Application|Factory|View|RedirectResponse|JsonResponse
    {
        if ($request->isMethod('POST')) {
            $this->meetingService->save($request->all());

            return $this->createdResponse();
        }

        return view('inspector.meetings.form', [
            'item' => new Meeting(),
            'title' => __('inspector.meetings.form.create.title'),
            'statuses' => $this->statusRepository->findAll(Meeting::$resourceType)
        ]);
    }

    /**
     * @param MeetingRequest $request
     * @param int $id
     * @return Application|Factory|View|RedirectResponse|JsonResponse
     * @throws Exception
     */
    public function update(MeetingRequest $request, int $id): Application|Factory|View|RedirectResponse|JsonResponse
    {
        $item = $this->meetingRepository->find($id);
        if (!$item) {
            return $this->noItem();
        }

        if ($request->isMethod('POST')) {
            $this->meetingService->save($request->all(), $item);

            return $this->updatedResponse();
        }

        return view('inspector.meetings.form', [
            'item' => $item,
            'title' => __('inspector.meetings.form.edit.title'),
            'statuses' => $this->statusRepository->findAll(Meeting::$resourceType)
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function remove(int $id): JsonResponse
    {
        $item = $this->meetingRepository->find($id);
        if (!$item) {
            return $this->itemNoExist();
        }

        $this->meetingService->remove($item);

        return $this->successRemoved();
    }

    public function getParticipants()
    {
        $data = $this->employeeRepository->findBy([], 'id', 'DESC', 10);

        return EmployeesResource::collection($data);
    }
}
