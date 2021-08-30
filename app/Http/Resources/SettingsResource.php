<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use \JsonSerializable;
use \Illuminate\Contracts\Support\Arrayable;
use \Illuminate\Http\Request;

class SettingsResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    #[ArrayShape([
        'id' => "int",
        'name' => "string",
        'value' => "string",
        'type' => 'int'
    ])] public function toArray($request): array|Arrayable|JsonSerializable
    {
        return [
            'id' => $this->id,
            'name' => __('settings.'.$this->name),
            'value' => $this->getValue(),
            'type' => $this->type
        ];
    }
}
