<?php

namespace App\Http\Resources\Tasks;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use JsonSerializable;
use Illuminate\Contracts\Support\Arrayable;

class TaskResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|Arrayable|JsonSerializable
    {
        return [
            'id' => $this->id,
            'number' => $this->number,
            'name' => $this->name,
            'deadline' => $this->deadline,
            'status' => $this->status?->name,
            'created_at' => (string)$this->created_at,
        ];
    }
}
