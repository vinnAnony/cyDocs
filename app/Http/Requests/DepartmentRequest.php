<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
{
    public function rules()
    {
        return [
            'department_name' => ['required','unique:departments,department_name'],
        ];
    }

    public function messages()
    {
        return [
            'department_name.required' => 'Department name required!',
            'department_name.unique' => 'Department name already exists!',
        ];
    }
}
