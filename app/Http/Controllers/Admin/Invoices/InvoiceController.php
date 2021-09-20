<?php

namespace App\Http\Controllers\Admin\Invoices;

use App\Http\Controllers\Controller;
use App\Http\Resources\Invoices\InvoicesResource;
use App\Repositories\Invoices\InvoiceRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class InvoiceController extends Controller
{
    /**
     * @param InvoiceRepository $invoiceRepository
     */
    public function __construct(
        private InvoiceRepository $invoiceRepository
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function __invoke(): Application|Factory|View
    {
        return view('admin.invoices.index', [
            'title' => __('admin.invoice.title')
        ]);
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function all(Request $request): AnonymousResourceCollection
    {
        $data = $this->invoiceRepository->findBy(
            $request->all(),
            $request->get('ordering_column', 'id'),
            $request->get('ordering_sort', 'DESC'),
            $request->get('pagination', 20)
        );

        return InvoicesResource::collection($data);
    }
}
