<?php

namespace App\Http\Resources\Certificates;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class CertificateResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $data = parent::toArray($request);
        $data['test'] = $this->test;
        $data['client_name'] = $this->client->name;
        $data['employee_name'] = $this->employee->user->name;

        return $data;
    }
}
