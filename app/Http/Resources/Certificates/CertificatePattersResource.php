<?php

namespace App\Http\Resources\Certificates;

use App\Http\Resources\Trainings\Tests\TestsResource;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;

class CertificatePattersResource extends JsonResource
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
            'tests' => TestsResource::collection($this->tests),
            'description' => $this->description
        ];
    }
}
