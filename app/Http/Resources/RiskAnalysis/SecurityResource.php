<?php

namespace App\Http\Resources\RiskAnalysis;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class SecurityResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'type' => $this->type,
            'status' => $this->status
        ];
    }
}
