<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'user_id' => 'required|exists:users,id',
            'full_name' => 'required|string|max:255',
            'agent_type_id' => 'required|exists:agent_types,id',
            'phone_number' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'license_number' => 'nullable|string|max:255',
            'license_issue_date' => 'nullable|date',
            'license_expiry_date' => 'nullable|date|after:license_issue_date',
            'national_id' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'agency_id' => 'nullable|exists:agencies,id',
        ];

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['user_id'] = 'required|exists:users,id|unique:agents,user_id,' . $this->agent->id;
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'user_id.required' => __('validation.required', ['attribute' => __('agents.user_id')]),
            'user_id.exists' => __('validation.exists', ['attribute' => __('agents.user_id')]),
            'user_id.unique' => __('validation.unique', ['attribute' => __('agents.user_id')]),
            'full_name.required' => __('validation.required', ['attribute' => __('agents.full_name')]),
            'full_name.string' => __('validation.string', ['attribute' => __('agents.full_name')]),
            'full_name.max' => __('validation.max.string', ['attribute' => __('agents.full_name'), 'max' => 255]),
            'agent_type_id.required' => __('validation.required', ['attribute' => __('agents.agent_type_id')]),
            'agent_type_id.exists' => __('validation.exists', ['attribute' => __('agents.agent_type_id')]),
            'phone_number.string' => __('validation.string', ['attribute' => __('agents.phone_number')]),
            'phone_number.max' => __('validation.max.string', ['attribute' => __('agents.phone_number'), 'max' => 20]),
            'email.email' => __('validation.email', ['attribute' => __('agents.email')]),
            'email.max' => __('validation.max.string', ['attribute' => __('agents.email'), 'max' => 255]),
            'license_number.string' => __('validation.string', ['attribute' => __('agents.license_number')]),
            'license_number.max' => __('validation.max.string', ['attribute' => __('agents.license_number'), 'max' => 255]),
            'license_issue_date.date' => __('validation.date', ['attribute' => __('agents.license_issue_date')]),
            'license_expiry_date.date' => __('validation.date', ['attribute' => __('agents.license_expiry_date')]),
            'license_expiry_date.after' => __('validation.after', ['attribute' => __('agents.license_expiry_date'), 'date' => __('agents.license_issue_date')]),
            'national_id.string' => __('validation.string', ['attribute' => __('agents.national_id')]),
            'national_id.max' => __('validation.max.string', ['attribute' => __('agents.national_id'), 'max' => 255]),
            'address.string' => __('validation.string', ['attribute' => __('agents.address')]),
            'agency_id.exists' => __('validation.exists', ['attribute' => __('agents.agency_id')]),
        ];
    }
} 