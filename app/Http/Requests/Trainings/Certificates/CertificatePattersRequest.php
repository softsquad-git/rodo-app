<?php

namespace App\Http\Requests\Trainings\Certificates;

use Illuminate\Foundation\Http\FormRequest;

class CertificatePattersRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
