<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\User;

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
        return view('user.profile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information, including the FAL license.
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
            'phone' => ['required', 'string', 'max:20', Rule::unique('users')->ignore($user->id)],
            'profile_photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'fal_license' => ['nullable', 'string', 'max:255'], // Add validation for the FAL license
        ]);

        // Update basic user information
        $user->forceFill([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

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
        
        // Save the user model with updated name, phone, and/or photo path
        $user->save();

        // Handle the FAL license
        // This robust method finds the agent record for the user and updates it.
        // If no agent record exists, it creates one with the user_id.
        // I noticed the Agent model uses 'license_number' in its fillable array, so we map to that.
        if ($request->filled('fal_license')) {
            $user->agent()->updateOrCreate(
                ['user_id' => $user->id], // The condition to find the record
                ['license_number' => $request->fal_license] // The value to update or create with
            );
        }

        // Redirect back to the profile page with a success message
        return redirect()->route('user.profile.edit')->with('status', 'profile-updated');
    }
}