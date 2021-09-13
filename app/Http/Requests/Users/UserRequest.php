<?php

namespace App\Http\Requests\Users;

use App\Helpers\Role;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            if ($this->get('role') == Role::$role['INSPECTOR']) {
                $rules['password'] = 'required|string|min:8|confirmed';
            }

            $rules['first_name'] = 'required|string|min:3';
            $rules['last_name'] = 'required|string|min:3';
            $rules['email'] = 'required|email';
        }

        return $rules;
    }
}
