<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Plan;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'terms' => ['accepted'],
        ], [
            'terms.accepted' => 'You must agree to the terms and conditions.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        Auth::login($user);

        // Create or find a free plan that grants 1 normal ad and assign it to the new user.
        // We keep this plan idempotent by searching for a plan named 'Free' targeted to users.
        $freePlan = Plan::firstOrCreate(
            ['name->en' => 'Free', 'target_type' => 'user'],
            [
                'price_monthly' => 0.00,
                'ads_regular' => 1,
                'ads_featured' => 0,
                'ads_premium' => 0,
                'ads_map' => 0,
                'agent_seats' => 0,
                'description' => json_encode(['en' => 'Free plan with 1 normal ad']),
            ]
        );

        // Create an active subscription for the new user using the free plan for 1 year.
        try {
            Subscription::create([
                'user_id' => $user->id,
                'plan_id' => $freePlan->id,
                'start_date' => Carbon::now()->toDateString(),
                'end_date' => Carbon::now()->addYear()->toDateString(),
                'status' => 'active',
            ]);
        } catch (\Exception $e) {
            // Log but do not interrupt registration flow if subscription creation fails.
            \Log::warning('Failed to create free subscription for user: ' . $user->id . ' - ' . $e->getMessage());
        }

        // ** THE AJAX FIX **
        if ($request->wantsJson()) {
            // On success, respond with the redirect path.
            return response()->json(['redirect' => route('home')]);
        }

        return redirect(route('home'));
    }
}