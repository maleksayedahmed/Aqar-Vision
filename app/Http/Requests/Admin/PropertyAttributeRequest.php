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
            
            // CORRECTED: Use the new 'image_or_svg' custom rule.
            // 'file' ensures it's a file, 'max' checks the size in kilobytes.
            'icon' => ['nullable', 'file', 'image_or_svg', 'max:1024'], 
        ];
    }

    public function messages(): array
    {
        return [
            'name.en.required' => __('validation.required', ['attribute' => __('attributes.property_attributes.name_en')]),
            'name.ar.required' => __('validation.required', ['attribute' => __('attributes.property_attributes.name_ar')]),
            'type.required' => __('validation.required', ['attribute' => __('attributes.property_attributes.type')]),
            'type.in' => __('validation.in', ['attribute' => __('attributes.property_attributes.type')]),
            
            // ADDED: A custom message for our new rule
            'icon.image_or_svg' => 'The icon must be a valid image (jpg, png, webp) or an SVG file.',
        ];
    }
}