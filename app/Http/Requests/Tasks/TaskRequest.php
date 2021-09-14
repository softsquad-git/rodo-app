<?php

namespace App\Http\Requests\Tasks;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
        $rules = [];
        if ($this->isMethod('post')) {
            $rules = [
                'user_id' => 'required|integer',
                'name' => 'required|string',
                'description' => 'required|string',
                'deadline' => 'required',
                'status_id' => 'required|integer'
            ];
        }

        return $rules;
    }
}
