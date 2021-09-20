<?php

namespace App\Http\Controllers\Admin\Certificates;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Certificates\CertificateRequest;
use App\Repositories\Certificates\CertificateRepository;
use App\Services\Certificates\CertificateService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Exception;

class CertificateController extends ApiController
{
    public function __construct(
        private CertificateService $certificateService,
        private CertificateRepository $certificateRepository
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function __invoke(): Application|Factory|View
    {
        return view('admin.trainings.certificates.index', [
            'title' => __('admin.trainings.certificates.title')
        ]);
    }

    public function all(Request $request)
    {

    }

    public function create(CertificateRequest $request)
    {

    }

    public function update(CertificateRequest $request, int $id)
    {

    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function remove(int $id): JsonResponse
    {
        $item = $this->certificateRepository->find($id);
        if (!$item) {
            return $this->itemNoExist();
        }

        $this->certificateService->remove($item);

        return $this->successRemoved();
    }
}
