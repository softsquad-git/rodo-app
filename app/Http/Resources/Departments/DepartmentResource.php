<?php

namespace App\Http\Resources\Departments;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class DepartmentResource extends JsonResource
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
            'status' => $this->status?->name,
            'created_at' => (string)$this->created_at,
            'employees' => DepartmentEmployeeResource::collection($this->employees)
        ];
    }
}
