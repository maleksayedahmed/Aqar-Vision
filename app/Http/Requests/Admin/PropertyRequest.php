<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PropertyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'neighborhood' => 'nullable|string|max:255',
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

            // For dynamic attributes
            'attributes' => 'nullable|array',
            'attributes.*' => 'nullable', // Basic validation for now
        ];
    }
}
