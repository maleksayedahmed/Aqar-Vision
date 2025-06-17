<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'exists:roles,name'],
            'is_active' => ['boolean'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('validation.required', ['attribute' => __('users.name')]),
            'email.required' => __('validation.required', ['attribute' => __('users.email')]),
            'email.email' => __('validation.email', ['attribute' => __('users.email')]),
            'email.unique' => __('validation.unique', ['attribute' => __('users.email')]),
            'password.required' => __('validation.required', ['attribute' => __('users.password')]),
            'password.min' => __('validation.min.string', ['attribute' => __('users.password'), 'min' => 8]),
            'password.confirmed' => __('validation.confirmed', ['attribute' => __('users.password')]),
            'role.required' => __('validation.required', ['attribute' => __('users.role')]),
            'role.exists' => __('validation.exists', ['attribute' => __('users.role')]),
        ];
    }
} 