<?php

namespace App\Http\Resources\Trainings\Tests;

use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;

class TestQuestionsResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    #[ArrayShape(['id' => "mixed", 'name' => "mixed", 'created_at' => "mixed"])] public function toArray($request): array|Arrayable|JsonSerializable
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => $this->created_at
        ];
    }
}
