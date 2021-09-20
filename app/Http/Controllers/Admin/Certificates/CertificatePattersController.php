<?php

namespace App\Http\Controllers\Admin\Certificates;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Trainings\Certificates\CertificatePattersRequest;
use App\Http\Resources\Certificates\CertificatePattersResource;
use App\Models\Certificates\CertificatePattern;
use App\Repositories\Certificates\CertificatePattersRepository;
use App\Repositories\Settings\StatusRepository;
use App\Repositories\Trainings\Tests\TestRepository;
use App\Services\Certificates\CertificatePattersService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Exception;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CertificatePattersController extends ApiController
{
    /**
     * @param CertificatePattersRepository $certificatePattersRepository
     * @param CertificatePattersService $certificatePattersService
     * @param TestRepository $testRepository
     * @param StatusRepository $statusRepository
     */
    public function __construct(
        private CertificatePattersRepository $certificatePattersRepository,
        private CertificatePattersService $certificatePattersService,
        private TestRepository $testRepository,
        private StatusRepository $statusRepository
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function __invoke(): Application|Factory|View
    {
        return view('admin.trainings.certificates.patters.index', [
            'title' => __('admin.trainings.certificates.patters.title')
        ]);
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function all(Request $request): AnonymousResourceCollection
    {
        $data = $this->certificatePattersRepository->findBy(
            $request->all(),
            $request->get('ordering_column', 'id'),
            $request->get('ordering_sort', 'DESC'),
            $request->get('pagination', 20)
        );

        return CertificatePattersResource::collection($data);
    }

    /**
     * @param CertificatePattersRequest $request
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function create(CertificatePattersRequest $request): Application|Factory|View|RedirectResponse
    {
        if ($request->isMethod('POST')) {
            $this->certificatePattersService->save($request->all());

            return redirect()->route('admin.certificates.patters.index')
                ->with('notification.success', __('admin.notifications.created'));
        }

        return view('admin.trainings.certificates.patters.form', [
            'title' => __('admin.trainings.certificates.patters.form.create.title'),
            'item' => new CertificatePattern(),
            'tests' => $this->testRepository->findAll(),
            'statuses' => $this->statusRepository->findAll(CertificatePattern::$resourceType)
        ]);
    }

    /**
     * @param CertificatePattersRequest $request
     * @param int $id
     * @return Application|Factory|View|RedirectResponse
     * @throws Exception
     */
    public function update(CertificatePattersRequest $request, int $id): Application|Factory|View|RedirectResponse
    {
        $item = $this->certificatePattersRepository->find($id);
        if (!$item) {
            return $this->noItem();
        }

        if ($request->isMethod('POST')) {
            $this->certificatePattersService->save($request->all(), $item);

            return redirect()->route('admin.certificates.patters.index')
                ->with('notification.success', __('admin.notifications.updated'));
        }

        return view('admin.trainings.certificates.patters.form', [
            'title' => __('admin.trainings.certificates.patters.form.edit.title'),
            'item' => $item,
            'tests' => $this->testRepository->findAll(),
            'statuses' => $this->statusRepository->findAll(CertificatePattern::$resourceType)
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function remove(int $id): JsonResponse
    {
        $item = $this->certificatePattersRepository->find($id);
        if (!$item) {
            return $this->itemNoExist();
        }

        $this->certificatePattersService->remove($item);

        return $this->successRemoved();
    }
}
