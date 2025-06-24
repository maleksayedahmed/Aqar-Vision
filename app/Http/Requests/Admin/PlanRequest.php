<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PlanRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name.en' => 'required|string|max:255',
            'name.ar' => 'required|string|max:255',
            'target_type' => 'required|in:agent,agency',
            'price_monthly' => 'required|numeric|min:0',
            'ads_regular' => 'required|integer|min:0',
            'ads_featured' => 'required|integer|min:0',
            'ads_premium' => 'required|integer|min:0',
            'ads_map' => 'required|integer|min:0',
            'agent_seats' => 'nullable|integer|min:0',
            'description.en' => 'nullable|string',
            'description.ar' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.en.required' => __('validation.required', ['attribute' => __('attributes.plans.name_en')]),
            'name.ar.required' => __('validation.required', ['attribute' => __('attributes.plans.name_ar')]),
            'target_type.required' => __('validation.required', ['attribute' => __('attributes.plans.target_type')]),
            'price_monthly.required' => __('validation.required', ['attribute' => __('attributes.plans.price_monthly')]),
            'price_monthly.numeric' => __('validation.numeric', ['attribute' => __('attributes.plans.price_monthly')]),
            'ads_regular.required' => __('validation.required', ['attribute' => __('attributes.plans.ads_regular')]),
            'ads_regular.integer' => __('validation.integer', ['attribute' => __('attributes.plans.ads_regular')]),
        ];
    }
}
