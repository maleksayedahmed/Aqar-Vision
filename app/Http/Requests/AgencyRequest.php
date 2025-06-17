<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgencyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'user_id' => 'required|exists:users,id',
            'agency_name' => 'required|array',
            'agency_name.en' => 'required|string|max:255',
            'agency_name.ar' => 'required|string|max:255',
            'agency_type_id' => 'required|exists:agency_types,id',
            'commercial_register_number' => 'nullable|string|max:255',
            'commercial_issue_date' => 'nullable|date',
            'commercial_expiry_date' => 'nullable|date|after:commercial_issue_date',
            'tax_id' => 'nullable|string|max:255',
            'tax_issue_date' => 'nullable|date',
            'tax_expiry_date' => 'nullable|date|after:tax_issue_date',
            'address' => 'nullable|array',
            'address.en' => 'nullable|string',
            'address.ar' => 'nullable|string',
            'phone_number' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'accreditation_status' => 'nullable|array',
            'accreditation_status.en' => 'nullable|string|max:255',
            'accreditation_status.ar' => 'nullable|string|max:255',
        ];

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['user_id'] = 'required|exists:users,id|unique:agencies,user_id,' . $this->agency->id;
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'user_id.required' => __('validation.required', ['attribute' => __('agencies.user_id')]),
            'user_id.exists' => __('validation.exists', ['attribute' => __('agencies.user_id')]),
            'user_id.unique' => __('validation.unique', ['attribute' => __('agencies.user_id')]),
            'agency_name.required' => __('validation.required', ['attribute' => __('agencies.agency_name')]),
            'agency_name.array' => __('validation.array', ['attribute' => __('agencies.agency_name')]),
            'agency_name.en.required' => __('validation.required', ['attribute' => __('agencies.agency_name_en')]),
            'agency_name.ar.required' => __('validation.required', ['attribute' => __('agencies.agency_name_ar')]),
            'agency_type_id.required' => __('validation.required', ['attribute' => __('agencies.agency_type_id')]),
            'agency_type_id.exists' => __('validation.exists', ['attribute' => __('agencies.agency_type_id')]),
            'commercial_register_number.string' => __('validation.string', ['attribute' => __('agencies.commercial_register_number')]),
            'commercial_issue_date.date' => __('validation.date', ['attribute' => __('agencies.commercial_issue_date')]),
            'commercial_expiry_date.date' => __('validation.date', ['attribute' => __('agencies.commercial_expiry_date')]),
            'commercial_expiry_date.after' => __('validation.after', ['attribute' => __('agencies.commercial_expiry_date'), 'date' => __('agencies.commercial_issue_date')]),
            'tax_id.string' => __('validation.string', ['attribute' => __('agencies.tax_id')]),
            'tax_issue_date.date' => __('validation.date', ['attribute' => __('agencies.tax_issue_date')]),
            'tax_expiry_date.date' => __('validation.date', ['attribute' => __('agencies.tax_expiry_date')]),
            'tax_expiry_date.after' => __('validation.after', ['attribute' => __('agencies.tax_expiry_date'), 'date' => __('agencies.tax_issue_date')]),
            'address.array' => __('validation.array', ['attribute' => __('agencies.address')]),
            'address.en.string' => __('validation.string', ['attribute' => __('agencies.address_en')]),
            'address.ar.string' => __('validation.string', ['attribute' => __('agencies.address_ar')]),
            'phone_number.string' => __('validation.string', ['attribute' => __('agencies.phone_number')]),
            'phone_number.max' => __('validation.max.string', ['attribute' => __('agencies.phone_number'), 'max' => 20]),
            'email.email' => __('validation.email', ['attribute' => __('agencies.email')]),
            'accreditation_status.array' => __('validation.array', ['attribute' => __('agencies.accreditation_status')]),
            'accreditation_status.en.string' => __('validation.string', ['attribute' => __('agencies.accreditation_status_en')]),
            'accreditation_status.ar.string' => __('validation.string', ['attribute' => __('agencies.accreditation_status_ar')]),
        ];
    }
} 