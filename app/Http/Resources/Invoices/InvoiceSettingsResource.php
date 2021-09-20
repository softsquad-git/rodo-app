<?php

namespace App\Http\Resources\Invoices;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
class InvoiceSettingsResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => [
                'key' => $this->name,
                'name' => $this->getName()
            ],
            'value' => $this->value
        ];
    }
}
