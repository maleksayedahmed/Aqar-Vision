<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\License;
use App\Models\LicenseType;
use Illuminate\Support\Facades\Auth;    // <-- Import Auth
use Illuminate\Http\RedirectResponse; // <-- Import RedirectResponse
use Illuminate\View\View;            // <-- Import View

class UserProfileController extends Controller
{
    /**
     * Display the user's profile form OR redirect if they are an agent.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request): View|RedirectResponse
    {
        $user = Auth::user(); // Get the currently authenticated user

        // ** THIS IS THE FIX **
        // Check if the authenticated user has an associated agent profile.
        if ($user && $user->agent) {
            // If they are an agent, redirect them immediately to the agent profile page.
            return redirect()->route('agent.profile.edit');
        }

        // If the code reaches here, the user is NOT an agent.
        // Proceed with the original logic for a regular user.
        $user->load(['latestUpgradeRequest.license', 'agent.licenses']);

        return view('user.profile', [
            'user' => $user,
        ]);
    }

    /**
     * Update the user's profile information, including email, password, and FAL license.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        // Validate all incoming data from the form
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['required', 'string', 'max:20', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'profile_photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'fal_license' => ['nullable', 'string', 'max:255'],
            'license_issue_date' => ['nullable', 'date'],
            'license_expiry_date' => ['nullable', 'date', 'after:license_issue_date'],
        ]);

        // Update basic user information
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        // Update password if provided
        if ($request->filled('password')) {
            $userData['password'] = bcrypt($request->password);
        }

        $user->forceFill($userData);

        // Handle the profile photo upload
        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->profile_photo_path = $path;
        }

        $user->save();

        // Handle the FAL license for agents only
        if ($user->agent && ($request->filled('fal_license') || $request->filled('license_issue_date') || $request->filled('license_expiry_date'))) {
            $falLicenseType = LicenseType::firstOrCreate(
                ['name->en' => 'FAL License'],
                [
                    'name' => ['en' => 'FAL License', 'ar' => 'رخصة فال'],
                    'description' => ['en' => 'FAL License for Real Estate Agents', 'ar' => 'رخصة فال للوسطاء العقاريين'],
                    'is_active' => true,
                ]
            );

            $licenseData = [
                'license_type_id' => $falLicenseType->id,
                'agent_id' => $user->agent->id,
                'issuer' => 'FAL',
                'license_number' => $request->fal_license,
                'issue_date' => $request->license_issue_date,
                'expiry_date' => $request->license_expiry_date,
            ];
            
            $user->agent->licenses()->updateOrCreate(
                ['license_type_id' => $falLicenseType->id],
                $licenseData
            );
        }

        return redirect()->route('user.profile.edit')->with('status', 'profile-updated');
    }
}