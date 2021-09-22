<?php

namespace App\Http\Resources\Documents;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class DocumentsResource extends JsonResource
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
            'type' => $this->type?->name,
            'valid_to' => $this->is_indefinitely ? 'Bezterminowo' : $this->valid_to,
            'status' => $this->status,
            'required_confirmation' => [
                'code' => $this->is_required_confirmation,
                'name' => $this->is_required_confirmation ? 'Tak' : 'Nie'
            ],
            'attachments' => DocumentAttachmentResource::collection($this->attachments)
        ];
    }
}
