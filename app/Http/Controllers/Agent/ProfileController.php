<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Display the agent's profile form.
     */
    public function edit(Request $request)
    {
        return view('agent.profile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the agent's profile information.
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'profile_photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $user->forceFill([
            'name' => $request->name,
            'phone' => $request->phone,
        ])->save();

        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }
            
            $path = $request->file('profile_photo')->store('profile-photos', 'public');

            $user->forceFill([
                'profile_photo_path' => $path,
            ])->save();
        }

        return redirect()->route('agent.profile.edit')->with('status', 'profile-updated');
    }
}