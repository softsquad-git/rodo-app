<?php

namespace App\Http\Resources\Applications;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class ApplicationConclusionsResource extends JsonResource
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
            'title' => $this->title,
            'name' => $this->name,
            'date_application' => $this->date_application,
            'type' => $this->type?->name,
            'status' => $this->status?->name,
            'employee_accepted' => $this->acceptedEmployee?->user?->name,
            'status_id' => $this->status_id
        ];
    }
}
