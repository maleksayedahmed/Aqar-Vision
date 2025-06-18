<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LicenseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'license_type_id' => 'required|exists:license_types,id',
            'license_number' => 'required|string|max:255|unique:licenses,license_number,' . $this->license,
            'issuer' => 'nullable|string|max:255',
            'issue_date' => 'nullable|date',
            'expiry_date' => 'nullable|date|after_or_equal:issue_date',
            'agent_id' => 'nullable|exists:agents,id',
            'agency_id' => 'nullable|exists:agencies,id',
        ];
    }

    public function messages()
    {
        return [
            'license_type_id.required' => __('validation.required', ['attribute' => __('licenses.license_type')]),
            'license_type_id.exists' => __('validation.exists', ['attribute' => __('licenses.license_type')]),
            'license_number.required' => __('validation.required', ['attribute' => __('licenses.license_number')]),
            'license_number.string' => __('validation.string', ['attribute' => __('licenses.license_number')]),
            'license_number.max' => __('validation.max.string', ['attribute' => __('licenses.license_number'), 'max' => 255]),
            'license_number.unique' => __('validation.unique', ['attribute' => __('licenses.license_number')]),
            'issuer.string' => __('validation.string', ['attribute' => __('licenses.issuer')]),
            'issuer.max' => __('validation.max.string', ['attribute' => __('licenses.issuer'), 'max' => 255]),
            'issue_date.date' => __('validation.date', ['attribute' => __('licenses.issue_date')]),
            'expiry_date.date' => __('validation.date', ['attribute' => __('licenses.expiry_date')]),
            'expiry_date.after_or_equal' => __('validation.after_or_equal', ['attribute' => __('licenses.expiry_date'), 'date' => __('licenses.issue_date')]),
            'agent_id.exists' => __('validation.exists', ['attribute' => __('licenses.agent')]),
            'agency_id.exists' => __('validation.exists', ['attribute' => __('licenses.agency')]),
        ];
    }
} 