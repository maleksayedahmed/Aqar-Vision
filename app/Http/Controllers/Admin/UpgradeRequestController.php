<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Agency;
use App\Models\AgencyType;
use App\Models\AgentType;
use App\Models\UpgradeRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class UpgradeRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = UpgradeRequest::with(['user', 'processor'])
            ->orderByRaw("FIELD(status, 'pending') DESC")
            ->latest()
            ->paginate(20);

        return view('admin.upgrade-requests.index', compact('requests'));
    }

    /**
     * Approve the specified upgrade request.
     */
    public function approve(UpgradeRequest $upgradeRequest): RedirectResponse
    {
        $user = $upgradeRequest->user;
        $role = $upgradeRequest->requested_role; // 'agent' or 'agency'

        // 1. Sync the user's role (e.g., to 'agent')
        $user->syncRoles([$role]);
        
        // 2. Ensure the user's account is active
        $user->update(['is_active' => true]);

        // 3. Update the request status
        $upgradeRequest->update([
            'status' => 'approved',
            'processed_by' => Auth::id(),
            'processed_at' => now(),
        ]);

        // Mark admin notification as read
        Auth::user()->notifications()->where('data->request_id', $upgradeRequest->id)->first()?->markAsRead();

        return back()->with('success', "Request approved. User {$user->name} is now an active {$role}.");
    }

    /**
     * Reject the specified upgrade request.
     */
    public function reject(Request $request, UpgradeRequest $upgradeRequest): JsonResponse|RedirectResponse
    {
        // 1. Find and delete the corresponding agent profile
        if ($upgradeRequest->user && $upgradeRequest->user->agent) {
            $upgradeRequest->user->agent()->delete();
        }

        // 2. Update the request status
        $upgradeRequest->update([
            'status' => 'rejected',
            'admin_notes' => $request->input('rejection_reason'),
            'processed_by' => Auth::id(),
            'processed_at' => now(),
        ]);
        
        // Mark admin notification as read
        Auth::user()->notifications()->where('data->request_id', $upgradeRequest->id)->first()?->markAsRead();

        // 3. Respond based on the request type
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Request has been rejected successfully.']);
        }

        return back()->with('success', 'Request has been rejected and the pending agent profile has been removed.');
    }
}