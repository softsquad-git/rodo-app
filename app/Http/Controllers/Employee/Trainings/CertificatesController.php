<?php

namespace App\Http\Controllers\Employee\Trainings;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Certificates\CertificateResource;
use PDF;
use App\Repositories\Employees\EmployeeCertificateRepository;
use App\Services\Employees\EmployeeCertificateService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class CertificatesController extends ApiController
{
    public function __construct(
        private EmployeeCertificateRepository $employeeCertificateRepository,
        private EmployeeCertificateService $employeeCertificateService
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function __invoke(): Application|Factory|View
    {
        return view('employee.trainings.certificates.index', [
            'title' => __('employee.trainings.certificates.title')
        ]);
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function all(Request $request): AnonymousResourceCollection
    {
        $filters = $request->all();
        $filters['employee_id'] = Auth::user()->employee->id;
        $data = $this->employeeCertificateRepository->findBy(
            $filters
        );

        return CertificateResource::collection($data);
    }

    public function download(int $id)
    {
        $certificate = $this->employeeCertificateRepository->find($id);
        if (!$certificate) {
            return $this->itemNoExist();
        }

        $fileContent = $this->employeeCertificateService->generateFileData($certificate);

        $pdf = PDF::loadView('pdf.pdf_employee_certificate', ['content' => $fileContent]);
        return $pdf->download('pdfview.pdf');
    }
}
