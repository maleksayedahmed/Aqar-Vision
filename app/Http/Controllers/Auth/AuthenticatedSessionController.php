<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Agent; // This is already here, which is good.

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Get the authenticated user
        $user = Auth::user();

        // --- START OF THE FIX ---

        // Check if the user has an associated agent profile.
        // It's cleaner to use the Eloquent relationship if you have one defined on the User model.
        // This will be null if the user is not an agent.
        $agent = $user->agent;

        // First, check if an agent record even exists for this user.
        if ($agent) {
            // The user IS an agent. Now it's safe to check their properties.
            // The logic to check 'has_visited_active' is in the Agent HomeController,
            // so we just need to redirect them to the agent area.
            return redirect()->intended(route('agent.home', absolute: false));
        }

        // If the 'if' condition fails, it means the user is not an agent.
        // Proceed with the default redirection for regular users.
        return redirect()->intended(route('home', absolute: false));

        // --- END OF THE FIX ---
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}