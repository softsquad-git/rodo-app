<?php

namespace App\Http\Resources\Trainings;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class TrainingGroupResource extends JsonResource
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
            'trainings' => $this->trainings,
            'departments' => $this->departments,
            'tests' => $this->tests
        ];
    }
}
