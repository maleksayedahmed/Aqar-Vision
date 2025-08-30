<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\License;
use App\Models\LicenseType;

class UserProfileController extends Controller
{
    /**
     * Display the user's profile form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $user = $request->user();

        // Load the latest upgrade request and agent with licenses if exists
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
    public function update(Request $request)
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
            // Delete the old photo if it exists to save space
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            // Store the new photo and update the path on the user model
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->profile_photo_path = $path;
        }

        // Save the user model with updated information
        $user->save();

        // Handle the FAL license for agents only
        if ($user->agent && ($request->filled('fal_license') || $request->filled('license_issue_date') || $request->filled('license_expiry_date'))) {
            // Find or create FAL license type
            $falLicenseType = LicenseType::where('name->en', 'FAL License')->first();
            if (!$falLicenseType) {
                $falLicenseType = LicenseType::create([
                    'name' => ['en' => 'FAL License', 'ar' => 'رخصة فال'],
                    'description' => ['en' => 'FAL License for Real Estate Agents', 'ar' => 'رخصة فال للوسطاء العقاريين'],
                    'is_active' => true,
                ]);
            }

            // Find existing license or create new one
            $license = $user->agent->licenses()->where('license_type_id', $falLicenseType->id)->first();

            $licenseData = [
                'license_type_id' => $falLicenseType->id,
                'agent_id' => $user->agent->id,
                'issuer' => 'FAL',
            ];

            if ($request->filled('fal_license')) {
                $licenseData['license_number'] = $request->fal_license;
            }
            if ($request->filled('license_issue_date')) {
                $licenseData['issue_date'] = $request->license_issue_date;
            }
            if ($request->filled('license_expiry_date')) {
                $licenseData['expiry_date'] = $request->license_expiry_date;
            }

            if ($license) {
                $license->update($licenseData);
            } else {
                License::create($licenseData);
            }
        }

        // Redirect back to the profile page with a success message
        return redirect()->route('user.profile.edit')->with('status', 'profile-updated');
    }
}
