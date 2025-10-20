<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function checkout(Plan $plan)
    {
        return view('agent.checkout', compact('plan'));
    }

    public function subscribe(Request $request)
    {
        $plan = Plan::findOrFail($request->plan_id);

        // Simulate a successful payment
        // In a real application, you would integrate a payment gateway like Stripe or PayPal here

        // Create a subscription for the agent
        $request->user()->agent->subscribeTo($plan);

        return redirect()->route('agent.dashboard')->with('success', __('common.subscription_successful'));
    }
}
