<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Assuming any authenticated admin can perform these actions.
        // Change this if you have more specific authorization logic.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        // Get the agent ID from the route, if it exists (for update operations)
        $agentId = $this->agent ? $this->agent->id : null;

        return [
            'user_id' => 'required|exists:users,id|unique:agents,user_id,' . $agentId,
            'full_name' => 'required|string|max:255',
            'agent_type_id' => 'required|exists:agent_types,id',
            'agency_id' => 'nullable|exists:agencies,id',
            'city_id' => 'nullable|exists:cities,id', // Added city validation
            'phone_number' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'license_number' => 'nullable|string|max:255',
            'license_issue_date' => 'nullable|date',
            'license_expiry_date' => 'nullable|date|after_or_equal:license_issue_date',
            'national_id' => 'nullable|string|max:255',
            'address' => 'nullable|string',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'user_id.required' => __('validation.required', ['attribute' => __('agents.user_id')]),
            'user_id.exists' => __('validation.exists', ['attribute' => __('agents.user_id')]),
            'user_id.unique' => __('validation.unique', ['attribute' => __('agents.user_id')]),
            'full_name.required' => __('validation.required', ['attribute' => __('agents.full_name')]),
            'agent_type_id.required' => __('validation.required', ['attribute' => __('agents.agent_type_id')]),
            'license_expiry_date.after' => __('validation.after', ['attribute' => __('agents.license_expiry_date'), 'date' => __('agents.license_issue_date')]),
            'city_id.exists' => 'The selected city is invalid.',
        ];
    }
}