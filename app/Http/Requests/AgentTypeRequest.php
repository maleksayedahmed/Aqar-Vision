<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgentTypeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('validation.required', ['attribute' => __('attributes.agents.agent_type_name')]),
            'name.string' => __('validation.string', ['attribute' => __('attributes.agents.agent_type_name')]),
            'name.max' => __('validation.max.string', ['attribute' => __('attributes.agents.agent_type_name'), 'max' => 255]),
            'description.string' => __('validation.string', ['attribute' => __('attributes.agents.agent_type_description')]),
            'is_active.boolean' => __('validation.boolean', ['attribute' => __('attributes.agents.agent_type_is_active')]),
        ];
    }
} 