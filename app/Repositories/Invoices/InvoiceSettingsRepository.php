<?php

namespace App\Repositories\Invoices;

use App\Models\Invoices\InvoiceSetting;
use Illuminate\Database\Eloquent\Collection;

class InvoiceSettingsRepository
{
    /**
     * @param int $id
     * @return InvoiceSetting|null
     */
    public function find(int $id): ?InvoiceSetting
    {
        return InvoiceSetting::find($id);
    }

    /**
     * @return InvoiceSetting[]|Collection
     */
    public function findAll(): array|Collection
    {
        return InvoiceSetting::all();
    }

    /**
     * @param array $filters
     * @return InvoiceSetting|null
     */
    public function findByOne(array $filters): ?InvoiceSetting
    {
        return InvoiceSetting::where($filters)->first();
    }
}
