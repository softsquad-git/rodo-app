<?php

namespace App\Http\Resources\Documents;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class DocumentAttachmentResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type?->name,
            'file' => [
                'file' => $this->file,
                'url' => $this->getFile()
            ]
        ];
    }
}
