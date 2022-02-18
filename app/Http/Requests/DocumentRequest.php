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
            'role_id' => ['required'],
            'created_by' => ['required'],
            'department_id' => ['required'],
            'doc_file' => ['required',
                'mimes:pdf,csv,doc,docx,ppt',
                'max:2048'
            ],
        ];
    }

    public function messages()
    {
        return [
            'document_name.required' => 'Document name required!',
            'category_id.required' => 'Category name required!',
            'role_id.required' => 'Access level required!',
            'department_id.required' => 'Document department required!',
            'created_by.required' => 'Document creator is missing!',
            'document_file_path.required' => 'Document required!',
            'document_file_path.mimes' => 'Document can only be in pdf,csv,doc,docx or ppt format.',
            'document_file_path.max' => 'File size should not exceed 2MB',
        ];
    }
}
