<?php

namespace App\Http\Resources\Employees;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class EmployeesResource extends JsonResource
{
    /**
     * @param Request $request
     * @return string[]
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->user?->name,
            'number' => $this->number,
            'email' => $this->user?->email,
            'client' => $this->client?->name,
            'position' => $this->position,
            'departments' => $this->departments
        ];
    }
}
