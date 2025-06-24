<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubscriptionRequest;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::with('user', 'plan')->latest()->paginate(15);
        return view('admin.subscriptions.index', compact('subscriptions'));
    }

    public function create()
    {
        $users = User::where('is_active', true)->get();
        $plans = Plan::all();
        return view('admin.subscriptions.create', compact('users', 'plans'));
    }

    public function store(SubscriptionRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = auth()->id();

        Subscription::create($data);

        return redirect()->route('admin.subscriptions.index')->with('success', 'Subscription created successfully.');
    }

    public function edit(Subscription $subscription)
    {
        $users = User::where('is_active', true)->get();
        $plans = Plan::all();
        return view('admin.subscriptions.edit', compact('subscription', 'users', 'plans'));
    }

    public function update(SubscriptionRequest $request, Subscription $subscription)
    {
        $data = $request->validated();
        $data['updated_by'] = auth()->id();

        $subscription->update($data);

        return redirect()->route('admin.subscriptions.index')->with('success', 'Subscription updated successfully.');
    }

    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        return redirect()->route('admin.subscriptions.index')->with('success', 'Subscription deleted successfully.');
    }
}
