<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->user->id),
            ],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
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
            'password.min' => __('validation.min.string', ['attribute' => __('users.password'), 'min' => 8]),
            'password.confirmed' => __('validation.confirmed', ['attribute' => __('users.password')]),
            'role.required' => __('validation.required', ['attribute' => __('users.role')]),
            'role.exists' => __('validation.exists', ['attribute' => __('users.role')]),
        ];
    }
} 