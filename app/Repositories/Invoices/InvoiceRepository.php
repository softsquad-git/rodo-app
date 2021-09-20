<?php

namespace App\Repositories\Invoices;

use App\Models\Invoices\Invoice;
use Illuminate\Pagination\LengthAwarePaginator;

class InvoiceRepository
{
    /**
     * @param int $id
     * @return Invoice|null
     */
    public function find(int $id): ?Invoice
    {
        return Invoice::find($id);
    }

    /**
     * @param array $filters
     * @param string $orderingColumn
     * @param string $orderingSort
     * @param int $pagination
     * @return LengthAwarePaginator
     */
    public function findBy(
        array $filters,
        string $orderingColumn,
        string $orderingSort,
        int $pagination
    ): LengthAwarePaginator
    {
        $data = Invoice::orderBy($orderingColumn, $orderingSort);

        if (isset($filters['number']) && !empty($filters['number'])) {
            $data->where('number', $filters['number']);
        }

        if (isset($filters['date_issue']) && !empty($filters['date_issue'])) {
            $data->where('date_issue', $filters['date_issue']);
        }

        if (isset($filters['client_name']) && !empty($filters['client_name'])) {
            $data->where('client_name', $filters['client_name']);
        }

        if (isset($filters['nip']) && !empty($filters['nip'])) {
            $data->where('nip', $filters['nip']);
        }

        if (isset($filters['payment_date']) && !empty($filters['payment_date'])) {
            $data->where('payment_date', $filters['payment_date']);
        }

        if (isset($filters['days_after_deadline']) && !empty($filters['days_after_deadline'])) {
            $data->where('days_after_deadline', $filters['days_after_deadline']);
        }

        return $data->paginate($pagination);
    }
}
