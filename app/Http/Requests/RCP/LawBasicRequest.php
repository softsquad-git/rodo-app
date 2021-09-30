<?php

namespace App\Http\Requests\RCP;

use Illuminate\Foundation\Http\FormRequest;

class LawBasicRequest extends FormRequest
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

            ];
        }

        return $rules;
    }
}
