<?php

namespace App\Http\Resources\Assets;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class SystemItResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'symbol' => $this->symbol,
            'name' => $this->name,
            'description' => $this->description,
            'status' => $this->status,
            'owner' => $this->owner
        ];
    }
}
