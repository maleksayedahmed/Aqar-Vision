<?php

namespace App\Http\Controllers;

use App\Models\UpgradeRequest;
use App\Models\User;
use App\Models\Agent;
use App\Models\AgentType;
use App\Notifications\UserUpgradeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class UserRequestController extends Controller
{
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        // Only allow 'agent' role for this request
        $request->validate(['requested_role' => 'required|in:agent']);

        $user = Auth::user();

        // Prevent agents from submitting another request
        if ($user->agent) {
            return response()->json(['message' => 'Your account is already an agent account.', 'error' => true], 403);
        }

        // Prevent duplicate pending requests
        if (UpgradeRequest::where('user_id', $user->id)->where('status', 'pending')->exists()) {
            $message = 'You already have a pending upgrade request.';
            return response()->json(['message' => $message, 'error' => true], 409);
        }
        
        // Find a default agent type to assign
        $defaultAgentType = AgentType::where('is_active', true)->orderBy('id')->first();
        if (!$defaultAgentType) {
            $message = 'Cannot process request because no Agent Types are configured by the admin.';
            return response()->json(['message' => $message, 'error' => true], 500);
        }

        // 1. Create the UpgradeRequest record
        $newRequest = UpgradeRequest::create([
            'user_id' => $user->id,
            'requested_role' => $request->requested_role, // will be 'agent'
        ]);
        
        // 2. Create the corresponding Agent record immediately.
        // It's "inactive" by nature because the user's role is not yet 'agent'.
        Agent::create([
            'user_id' => $user->id,
            'full_name' => $user->name,
            'email' => $user->email,
            'phone_number' => $user->phone,
            'agent_type_id' => $defaultAgentType->id,
        ]);

        // 3. Notify admins
        $admins = User::role('admin')->get();
        if ($admins->isNotEmpty()) {
            Notification::send($admins, new UserUpgradeRequest($newRequest));
        }
        
        $message = 'تم إرسال طلب الترقية بنجاح!';
        return response()->json(['message' => $message, 'success' => true]);
    }
}