<?php

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class EmployeePermissionRequest extends FormRequest
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
        'employee_id' => "string",
        'application_number' => "string",
        'type' => "string",
        'name' => "string",
        'valid_from' => "string",
        'valid_to' => "string",
        'status_id' => "string"
    ])] public function rules(): array
    {
        return [
            'employee_id' => 'required|integer',
            'application_number' => 'required',
            'type' => 'required|string',
            'name' => 'required|string',
            'valid_from' => 'required',
            'valid_to' => 'required',
            'status_id' => 'required|integer'
        ];
    }
}
