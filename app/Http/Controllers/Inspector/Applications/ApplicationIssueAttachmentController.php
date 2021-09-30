<?php

namespace App\Http\Controllers\Inspector\Applications;

use App\Http\Controllers\ApiController;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Applications\ApplicationIssueRequest;
use App\Http\Resources\Applications\ApplicationIssuesResource;
use App\Models\Applications\ApplicationIssue;
use App\Repositories\Applications\ApplicationIssueRepository;
use App\Services\Applications\ApplicationIssueService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ApplicationIssueAttachmentController extends ApiController
{
    /**
     * @param ApplicationIssueRepository $applicationIssueRepository
     * @param ApplicationIssueService $applicationIssueService
     */
    public function __construct(
        private ApplicationIssueRepository $applicationIssueRepository,
        private ApplicationIssueService    $applicationIssueService
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function __invoke(): Application|Factory|View
    {
        return view('inspector.applications.issues.index', [
            'title' => __('inspector.applications.issues.title')
        ]);
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function all(Request $request): AnonymousResourceCollection
    {
        $data = $this->applicationIssueRepository->findBy(
            $request->all(),
            $request->get('ordering_column', 'id'),
            $request->get('ordering_sort', 'DESC'),
            $request->get('pagination', 20)
        );

        return ApplicationIssuesResource::collection($data);
    }

    /**
     * @param ApplicationIssueRequest $request
     * @return Application|Factory|View|JsonResponse
     * @throws Exception
     */
    public function create(ApplicationIssueRequest $request): Application|Factory|View|JsonResponse
    {
        if ($request->isMethod('POST')) {
            $this->applicationIssueService->save($request->all());

            return $this->createdResponse();
        }

        return view('inspector.applications.issues.form', [
            'item' => new ApplicationIssue(),
            'title' => __('inspector.applications.issues.form.create.title')
        ]);
    }

    /**
     * @param ApplicationIssueRequest $request
     * @param int $id
     * @return Application|Factory|View|JsonResponse|RedirectResponse
     * @throws Exception
     */
    public function update(ApplicationIssueRequest $request, int $id): Application|Factory|View|JsonResponse|RedirectResponse
    {
        $item = $this->applicationIssueRepository->find($id);
        if (!$item) {
            return $this->noItem();
        }

        if ($request->isMethod('POST')) {
            $this->applicationIssueService->save($request->all(), $item);

            return $this->updatedResponse();
        }

        return view('inspector.applications.issues.form', [
            'item' => $item,
            'title' => __('inspector.applications.issues.form.edit.title')
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function remove(int $id): JsonResponse
    {
        $item = $this->applicationIssueRepository->find($id);
        if (!$item) {
            return $this->itemNoExist();
        }

        $this->applicationIssueService->remove($item);

        return $this->successRemoved();
    }
}
