<?php

namespace App\Http\Controllers\Admin\Certificates;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Certificates\CertificateRequest;
use App\Http\Resources\Certificates\CertificateResource;
use App\Repositories\Employees\EmployeeCertificateRepository;
use App\Services\Certificates\CertificateService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Exception;

class CertificateController extends ApiController
{
    public function __construct(
        private EmployeeCertificateRepository $employeeCertificateRepository,
        private CertificateService $certificateService
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

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function all(Request $request): AnonymousResourceCollection
    {
        $data = $this->employeeCertificateRepository->findBy($request->all());

        return CertificateResource::collection($data);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function remove(int $id): JsonResponse
    {
        $item = $this->employeeCertificateRepository->find($id);
        if (!$item) {
            return $this->itemNoExist();
        }

        $this->certificateService->remove($item);

        return $this->successRemoved();
    }
}
