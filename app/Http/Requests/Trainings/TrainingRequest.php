<?php

namespace App\Http\Requests\Trainings;

use Illuminate\Foundation\Http\FormRequest;

class TrainingRequest extends FormRequest
{
    /*
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
            //
        }

        return $rules;
    }
}
