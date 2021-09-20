<?php

namespace App\Services\Invoices;

use App\Models\Invoices\InvoiceSetting;

class InvoiceSettingsService
{
    /**
     * @param array $data
     * @param InvoiceSetting $invoiceSetting
     * @return InvoiceSetting
     */
    public function update(array $data, InvoiceSetting $invoiceSetting): InvoiceSetting
    {
        $invoiceSetting->update($data);

        return $invoiceSetting;
    }
}
