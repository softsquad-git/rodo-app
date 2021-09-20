<?php

namespace App\Http\Resources\Invoices;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class InvoicesResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'number' => $this->number,
            'date_issue' => $this->date_issue,
            'client_name' => $this->client_name,
            'nip' => $this->nip,
            'payment_date' => $this->payment_date,
            'amount' => $this->amount,
            'days_after_deadline' => $this->days_after_deadline
        ];
    }
}
