<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function rules()
    {
        return [
            'category_name' => ['required','unique:categories,category_name'],
        ];
    }

    public function messages()
    {
        return [
            'category_name.required' => 'Category name required!',
            'category_name.unique' => 'Category name already exists!',
        ];
    }
}
