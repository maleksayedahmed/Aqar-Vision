<?php

namespace App\Http\Controllers;

use App\Models\UpgradeRequest;
use App\Models\User;
use App\Notifications\UserUpgradeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class UserRequestController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'requested_role' => 'required|in:agent,agency',
        ]);

        $user = Auth::user();

        // Prevent duplicate pending requests
        $existingRequest = UpgradeRequest::where('user_id', $user->id)
            ->where('status', 'pending')->exists();

        if ($existingRequest) {
            return back()->with('error', 'You already have a pending upgrade request.');
        }

        $newRequest = UpgradeRequest::create([
            'user_id' => $user->id,
            'requested_role' => $request->requested_role,
        ]);

        // Find all admins/super-admins to notify
        $admins = User::role('admin')->get(); 
        Notification::send($admins, new UserUpgradeRequest($newRequest));

        return back()->with('success', 'Your upgrade request has been submitted successfully!');
    }
}
