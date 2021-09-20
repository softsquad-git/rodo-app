<?php

namespace App\Http\Controllers\Admin\Invoices;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Invoices\InvoiceSettingRequest;
use App\Http\Resources\Invoices\InvoiceSettingsResource;
use App\Repositories\Invoices\InvoiceSettingsRepository;
use App\Services\Invoices\InvoiceSettingsService;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class InvoiceSettingsController extends ApiController
{
    /**
     * @param InvoiceSettingsRepository $invoiceSettingsRepository
     * @param InvoiceSettingsService $invoiceSettingsService
     */
    public function __construct(
        private InvoiceSettingsRepository $invoiceSettingsRepository,
        private InvoiceSettingsService $invoiceSettingsService
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function __invoke(): Application|Factory|View
    {
        return view('admin.invoices.settings.index', [
            'title' => __('admin.invoice.settings.title')
        ]);
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function all(Request $request): AnonymousResourceCollection
    {
        $data = $this->invoiceSettingsRepository->findAll();

        return InvoiceSettingsResource::collection($data);
    }

    /**
     * @param InvoiceSettingRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(InvoiceSettingRequest $request, int $id): JsonResponse
    {
        $item = $this->invoiceSettingsRepository->find($id);
        if (!$item) {
            return $this->itemNoExist();
        }

        $this->invoiceSettingsService->update($request->all(), $item);

        return $this->updatedResponse();
    }
}
