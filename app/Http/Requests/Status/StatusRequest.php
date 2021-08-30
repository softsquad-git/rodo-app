<?php

namespace App\Http\Requests\Status;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class StatusRequest extends FormRequest
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
    #[ArrayShape(['name' => "string"])] public function rules(): array
    {
        return [
            'name' => 'required|string'
        ];
    }
}
