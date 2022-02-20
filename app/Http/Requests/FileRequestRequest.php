<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileRequestRequest extends FormRequest
{
    public function rules()
    {
        return [
            'department_id' => ['required'],
            'category_id' => ['required'],
            'document_id' => ['required'],
            'requester_id' => ['sometimes'],
            'requester_message' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'department_id.required' => 'Department name required!',
            'category_id.required' => 'Category name required!',
            'document_id.required' => 'The document to be accessed is required!',
            'requester_message.required' => 'Write a message to the approver',
        ];
    }
}
