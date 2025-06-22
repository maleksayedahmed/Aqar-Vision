<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommercialRecordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'agency_id' => 'required|exists:agencies,id',
            'commercial_register_number' => 'required|string|max:255',
            'commercial_issue_date' => 'nullable|date',
            'commercial_expiry_date' => 'nullable|date|after:commercial_issue_date',
            'city' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'agency_id.required' => __('validation.required', ['attribute' => __('attributes.commercial_records.agency_id')]),
            'agency_id.exists' => __('validation.exists', ['attribute' => __('attributes.commercial_records.agency_id')]),
            'commercial_register_number.required' => __('validation.required', ['attribute' => __('attributes.commercial_records.commercial_register_number')]),
            'commercial_register_number.string' => __('validation.string', ['attribute' => __('attributes.commercial_records.commercial_register_number')]),
            'commercial_register_number.max' => __('validation.max.string', ['attribute' => __('attributes.commercial_records.commercial_register_number'), 'max' => 255]),
            'commercial_issue_date.date' => __('validation.date', ['attribute' => __('attributes.commercial_records.commercial_issue_date')]),
            'commercial_expiry_date.date' => __('validation.date', ['attribute' => __('attributes.commercial_records.commercial_expiry_date')]),
            'commercial_expiry_date.after' => __('validation.after', ['attribute' => __('attributes.commercial_records.commercial_expiry_date'), 'date' => __('attributes.commercial_records.commercial_issue_date')]),
            'city.string' => __('validation.string', ['attribute' => __('attributes.commercial_records.city')]),
            'city.max' => __('validation.max.string', ['attribute' => __('attributes.commercial_records.city'), 'max' => 255]),
            'address.string' => __('validation.string', ['attribute' => __('attributes.commercial_records.address')]),
            'address.max' => __('validation.max.string', ['attribute' => __('attributes.commercial_records.address'), 'max' => 255]),
        ];
    }
} 