<?php

namespace App\Http\Requests\RCP;

use Illuminate\Foundation\Http\FormRequest;

class RCPActivityRequest extends FormRequest
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
