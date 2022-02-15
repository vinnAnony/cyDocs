<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentRequest extends FormRequest
{
    public function rules()
    {
        return [
            'document_title' => ['required', 'string', 'max:55'],
            'category_id' => ['required'],
            'department_id' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'document_name.required' => 'Document name required!',
            'category_id.required' => 'Category name required!',
            'department_id.required' => 'Document department required!',
        ];
    }
}
