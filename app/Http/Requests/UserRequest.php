<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'min:4'],
            'email' => ['required', 'email','unique:users,email,'.$this->get('id')],
            'password' => ['required', 'min:8'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'We need your name.',
            'name.min' => 'Provided name is too short',
            'email.required' => 'Your email is required!',
            'email.email' => 'Oops! Check your email address format.',
            'password.required' => 'Password required!',
            'password.min' => 'Password too weak. Should be more than 7 characters.',
        ];
    }
}
