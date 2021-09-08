<?php

namespace App\Http\Requests\Types;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class TypeRequest extends FormRequest
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
    #[ArrayShape(['name' => "string", 'resource_type' => "string"])] public function rules(): array
    {
        return [
            'name' => 'required|string',
            'resource_type' => 'nullable|string'
        ];
    }
}
