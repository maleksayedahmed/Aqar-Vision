<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PropertyAttributeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name.en' => 'required|string|max:255',
            'name.ar' => 'required|string|max:255',
            'type' => 'required|string|in:text,number,boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.en.required' => __('validation.required', ['attribute' => __('attributes.property_attributes.name_en')]),
            'name.ar.required' => __('validation.required', ['attribute' => __('attributes.property_attributes.name_ar')]),
            'type.required' => __('validation.required', ['attribute' => __('attributes.property_attributes.type')]),
            'type.in' => __('validation.in', ['attribute' => __('attributes.property_attributes.type')]),
        ];
    }
}
