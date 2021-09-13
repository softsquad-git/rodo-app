<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;

class UserResource extends JsonResource
{

    public function toArray($request): array|Arrayable|JsonSerializable
    {
        return [
            'id' => $this->id,
            'number' => $this->id,
            'name' => $this->name,
            'type' => 'sd',
            'status' => $this->status?->name,
            'email' => $this->email
        ];
    }
}
