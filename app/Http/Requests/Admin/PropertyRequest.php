<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PropertyRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',

            'district_id' => 'required|exists:districts,id',

            'street_width' => 'nullable|numeric',
            'facade' => 'nullable|string|max:255',
            'area_sq_meters' => 'nullable|numeric',
            'purpose_id' => 'required|exists:property_purposes,id',
            'price_per_unit' => 'nullable|numeric',
            'total_price' => 'required|numeric',
            'property_type_id' => 'required|exists:property_types,id',
            'age_years' => 'nullable|integer',
            'listing_purpose' => 'required|in:sale,rent',
            'contact_number' => 'nullable|string|max:255',
            'encumbrances' => 'nullable|string',
            'status' => 'required|in:available,sold,rented',
            'list_date' => 'nullable|date',
            'attributes' => 'nullable|array',
            'attributes.*' => 'nullable',
            'photos' => 'nullable|array',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => __('validation.required', ['attribute' => 'title']),
            'purpose_id.required' => __('validation.required', ['attribute' => __('attributes.properties.purpose')]),
            'property_type_id.required' => __('validation.required', ['attribute' => __('attributes.properties.type')]),
            'total_price.required' => __('validation.required', ['attribute' => __('attributes.properties.total_price')]),
            'listing_purpose.required' => __('validation.required', ['attribute' => __('attributes.properties.listing_purpose')]),
            'district_id.required' => __('validation.required', ['attribute' => 'District']),
        ];
    }
}