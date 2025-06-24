<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'plan_id' => 'required|exists:plans,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:active,expired,cancelled',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => __('validation.required', ['attribute' => __('attributes.subscriptions.user')]),
            'user_id.exists' => __('validation.exists', ['attribute' => __('attributes.subscriptions.user')]),
            'plan_id.required' => __('validation.required', ['attribute' => __('attributes.subscriptions.plan')]),
            'end_date.after_or_equal' => __('validation.after_or_equal', [
                'attribute' => __('attributes.subscriptions.end_date'),
                'date' => __('attributes.subscriptions.start_date'),
            ]),
        ];
    }
}
