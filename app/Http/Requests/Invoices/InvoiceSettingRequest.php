<?php

namespace App\Http\Requests\Invoices;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class InvoiceSettingRequest extends FormRequest
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
    #[ArrayShape(['value' => "string"])] public function rules(): array
    {
        return [
            'value' => 'required'
        ];
    }
}
