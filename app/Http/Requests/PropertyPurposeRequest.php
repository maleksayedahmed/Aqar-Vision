<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyPurposeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|array',
            'name.en' => 'required|string|max:255',
            'name.ar' => 'required|string|max:255',
            'description' => 'nullable|array',
            'description.en' => 'nullable|string',
            'description.ar' => 'nullable|string',
            'is_active' => 'boolean'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('validation.required', ['attribute' => __('property_purposes.name')]),
            'name.array' => __('validation.array', ['attribute' => __('property_purposes.name')]),
            'name.en.required' => __('validation.required', ['attribute' => __('property_purposes.name_en')]),
            'name.ar.required' => __('validation.required', ['attribute' => __('property_purposes.name_ar')]),
            'name.en.string' => __('validation.string', ['attribute' => __('property_purposes.name_en')]),
            'name.ar.string' => __('validation.string', ['attribute' => __('property_purposes.name_ar')]),
            'name.en.max' => __('validation.max.string', ['attribute' => __('property_purposes.name_en'), 'max' => 255]),
            'name.ar.max' => __('validation.max.string', ['attribute' => __('property_purposes.name_ar'), 'max' => 255]),
            'description.array' => __('validation.array', ['attribute' => __('property_purposes.description')]),
            'description.en.string' => __('validation.string', ['attribute' => __('property_purposes.description_en')]),
            'description.ar.string' => __('validation.string', ['attribute' => __('property_purposes.description_ar')]),
            'is_active.boolean' => __('validation.boolean', ['attribute' => __('property_purposes.is_active')]),
        ];
    }
} 