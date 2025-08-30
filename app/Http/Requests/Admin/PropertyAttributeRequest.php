<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; // <-- IMPORT THIS CLASS

class PropertyAttributeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name'      => ['required', 'array'],
            'name.en'   => ['required', 'string', 'max:255'],
            'name.ar'   => ['required', 'string', 'max:255'],
            'icon'      => ['nullable', 'file', 'mimes:svg,png,jpg,jpeg,webp', 'max:1024'],
            
            // ** THIS IS THE FIX **
            // The 'type' must now be either 'boolean' or 'dropdown'.
            'type'      => ['required', 'string', Rule::in(['boolean', 'dropdown'])],

            // The 'choices' array is only required IF the type is 'dropdown'.
            'choices'   => ['nullable', 'required_if:type,dropdown', 'array'],
            
            // If a choice row exists, both English and Arabic fields are required.
            'choices.*.en' => ['required_with:choices.*.ar', 'nullable', 'string', 'max:255'],
            'choices.*.ar' => ['required_with:choices.*.en', 'nullable', 'string', 'max:255'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'name.en.required' => __('validation.required', ['attribute' => __('attributes.property_attributes.name_en')]),
            'name.ar.required' => __('validation.required', ['attribute' => __('attributes.property_attributes.name_ar')]),
            'type.required' => __('validation.required', ['attribute' => __('attributes.property_attributes.type')]),
            'type.in' => __('validation.in', ['attribute' => __('attributes.property_attributes.type')]),
            'choices.required_if' => 'The choices field is required when the type is dropdown.',
        ];
    }
}