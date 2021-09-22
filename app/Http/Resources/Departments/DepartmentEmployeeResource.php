<?php

namespace App\Http\Resources\Departments;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class DepartmentEmployeeResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->user?->name
        ];
    }
}
