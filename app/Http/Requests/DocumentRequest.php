<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentRequest extends FormRequest
{
    public function rules()
    {
        return [
            'document_name' => ['required', 'string', 'max:55'],
            'document_category' => ['required',],
            'document_department' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'document_name.required' => 'Document name required!',
            'document_category.required' => 'Category name required!',
            'document_department.required' => 'Document department required!',
        ];
    }
}
