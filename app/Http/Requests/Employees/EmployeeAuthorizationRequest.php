<?php

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class EmployeeAuthorizationRequest extends FormRequest
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
    #[ArrayShape([
        'title' => "string",
        'valid_from' => "string",
        'valid_to' => "string",
        'employee_id' => "string"
    ])] public function rules(): array
    {
        return [
            'title' => 'required|string',
            'valid_from' => 'required',
            'valid_to' => 'required_id',
            'employee_id' => 'required|integer'
        ];
    }
}
