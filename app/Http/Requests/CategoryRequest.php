<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function rules()
    {
        return [
            'category_name' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'category_name.required' => 'Category name required!',
        ];
    }
}
