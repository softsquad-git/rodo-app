<?php

namespace App\Http\Resources\Newsletter;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class NewsletterPostResource extends JsonResource
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
            'from' => $this->from,
            'to' => $this->to,
            'status' => $this->status?->name,
        ];
    }
}
