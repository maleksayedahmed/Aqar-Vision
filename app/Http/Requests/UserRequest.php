<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ];

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['email'] = 'required|email|unique:users,email,' . $this->user->id;
            $rules['password'] = 'nullable|min:8|confirmed';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => __('validation.required', ['attribute' => __('users.name')]),
            'name.string' => __('validation.string', ['attribute' => __('users.name')]),
            'name.max' => __('validation.max.string', ['attribute' => __('users.name'), 'max' => 255]),
            'email.required' => __('validation.required', ['attribute' => __('users.email')]),
            'email.email' => __('validation.email', ['attribute' => __('users.email')]),
            'email.unique' => __('validation.unique', ['attribute' => __('users.email')]),
            'password.required' => __('validation.required', ['attribute' => __('users.password')]),
            'password.min' => __('validation.min.string', ['attribute' => __('users.password'), 'min' => 8]),
            'password.confirmed' => __('validation.confirmed', ['attribute' => __('users.password')]),
        ];
    }
} 