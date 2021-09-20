<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class SettingPasswordRequest extends FormRequest
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
    #[ArrayShape(['old_password' => "string", 'new_password' => "string"])] public function rules(): array
    {
        return [
            'old_password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8'
        ];
    }
}
