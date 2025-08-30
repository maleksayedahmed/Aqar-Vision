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
        $requests = UpgradeRequest::with(['user', 'processor', 'license'])
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

        // 1. Sync the user's role (e.g., to 'agent' or 'agency')
        $user->syncRoles([$role]);

        // 2. Ensure the user's account is active
        $user->update(['is_active' => true]);

        // 3. Create the appropriate profile if it doesn't exist
        if ($role === 'agent' && !$user->agent) {
            // Find a default agent type to assign
            $defaultAgentType = AgentType::where('is_active', true)->orderBy('id')->first();
            if ($defaultAgentType) {
                Agent::create([
                    'user_id' => $user->id,
                    'full_name' => $user->name,
                    'email' => $user->email,
                    'phone_number' => $user->phone,
                    'agent_type_id' => $defaultAgentType->id,
                ]);
            }
        } elseif ($role === 'agency' && !$user->agency) {
            // Find a default agency type
            $defaultAgencyType = AgencyType::where('is_active', true)->orderBy('id')->first();
            if ($defaultAgencyType) {
                Agency::create([
                    'user_id' => $user->id,
                    'agency_name' => $user->name,
                    'email' => $user->email,
                    'phone_number' => $user->phone,
                    'agency_type_id' => $defaultAgencyType->id,
                ]);
            }
        }

        // 4. Update the request status
        $upgradeRequest->update([
            'status' => 'approved',
            'processed_by' => Auth::id(),
            'processed_at' => now(),
        ]);

        return back()->with('success', "تم الموافقة على الطلب. المستخدم {$user->name} أصبح الآن {$role} نشط.");
    }

    /**
     * Reject the specified upgrade request.
     */
    public function reject(Request $request, UpgradeRequest $upgradeRequest): JsonResponse|RedirectResponse
    {
        // 1. Find and delete the corresponding agent or agency profile and license
        if ($upgradeRequest->user) {
            if ($upgradeRequest->requested_role === 'agent' && $upgradeRequest->user->agent) {
                $upgradeRequest->user->agent()->delete();
            } elseif ($upgradeRequest->requested_role === 'agency' && $upgradeRequest->user->agency) {
                $upgradeRequest->user->agency()->delete();
            }
        }

        // 2. Delete associated license if it exists
        if ($upgradeRequest->license) {
            $upgradeRequest->license->delete();
        }

        // 3. Update the request status
        $upgradeRequest->update([
            'status' => 'rejected',
            'admin_notes' => $request->input('rejection_reason'),
            'processed_by' => Auth::id(),
            'processed_at' => now(),
            'license_id' => null, // Remove license reference
        ]);

        // 4. Respond based on the request type
        if ($request->wantsJson()) {
            return response()->json(['message' => 'تم رفض الطلب بنجاح.']);
        }

        return back()->with('success', 'تم رفض الطلب وإزالة الملف الشخصي والرخصة المعلقة.');
    }
}
