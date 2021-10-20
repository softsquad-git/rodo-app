<?php

namespace App\Http\Resources\Trainings\Tests;

use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;

class TestsResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    #[ArrayShape([
        'id' => "int",
        'number' => "string",
        'name' => "string",
        'description' => "string",
        'group' => "string|null",
        'stat' => "array",
        'created_at' => "string",
        'departments' => "mixed",
        'questions_count' => 'int',
        'pass_threshold' => 'string'
    ])] public function toArray($request): array|Arrayable|JsonSerializable
    {
        return [
            'id' => $this->id,
            'number' => $this->number,
            'name' => $this->name,
            'description' => $this->description,
            'group' => $this->group?->name,
            'stat' => [
                'number_questions' => $this->number_questions,
                'pass_threshold' => $this->pass_threshold
            ],
            'created_at' => (string)$this->created_at,
            'departments' => $this->departments,
            'questions_count' => $this->questions()->count(),
            'pass_threshold' => $this->pass_threshold
        ];
    }
}
