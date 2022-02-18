<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    public function rules()
    {
        return [
            'role_name' => ['required','unique:roles,role_name,'.$this->get('id')],
            'role_description' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'role_name.required' => 'Role name required!',
            'role_name.unique' => 'Role name already exists!',
            'role_description.required' => 'Role description required!',
        ];
    }
}
