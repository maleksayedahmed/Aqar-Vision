<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\AgencyType;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form OR redirect if they are an agent.
     */
    public function edit(Request $request): View|RedirectResponse
    {
        $user = $request->user();

        // ** THIS IS THE FIX **
        // Check if the authenticated user has an associated agent profile.
        if ($user && $user->agent) {
            // If they are an agent, redirect them to the dedicated agent profile page.
            return redirect()->route('agent.profile.edit');
        }

        // If they are not an agent, proceed as normal and show the default profile view.
        return view('profile.edit', [
            'user' => $user,
            'agencyTypes' => AgencyType::all(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}