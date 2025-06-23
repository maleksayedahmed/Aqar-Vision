<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PlanRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name' => 'required|array',
            'name.en' => 'required|string|max:255',
            'name.ar' => 'required|string|max:255',
            'target_type' => 'required|in:agent,agency',
            'price_monthly' => 'required|numeric|min:0',
            'ads_regular' => 'required|integer|min:0',
            'ads_featured' => 'required|integer|min:0',
            'ads_premium' => 'required|integer|min:0',
            'ads_map' => 'required|integer|min:0',
            'agent_seats' => 'nullable|integer|min:0',
            'description' => 'nullable|array',
            'description.en' => 'nullable|string',
            'description.ar' => 'nullable|string',
        ];
    }
}
