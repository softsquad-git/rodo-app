<?php

namespace App\Http\Resources\Trainings;

use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;

class TrainingResource extends JsonResource
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
            'status' => $this->status?->name,
            'created_at' => (string)$this->created_at,
            'groups' => TrainingGroupResource::collection($this->groups)
        ];
    }
}
