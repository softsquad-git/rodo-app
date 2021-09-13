<?php

namespace App\Http\Resources\Clients;

use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;

class ClientsResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    #[ArrayShape([
        'id' => "int",
        'number' => "string",
        'short' => "string",
        'name' => "string",
        'type' => "string",
        'status' => "string"
    ])] public function toArray($request): array|Arrayable|JsonSerializable
    {
        return [
            'id' => $this->id,
            'number' => $this->auto_number,
            'short' => $this->short,
            'name' => $this->name,
            'type' => $this->type?->name,
            'status' => $this->status?->name
        ];
    }
}
