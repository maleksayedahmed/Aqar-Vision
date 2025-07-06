<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Agency;
use App\Models\AgencyType; // <-- Import AgencyType
use App\Models\AgentType;   // <-- Import AgentType
use App\Models\UpgradeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpgradeRequestController extends Controller
{
    public function index()
    {
        $requests = UpgradeRequest::with('user')
            ->orderByRaw("FIELD(status, 'pending') DESC")
            ->latest()
            ->paginate(20);

        return view('admin.upgrade-requests.index', compact('requests'));
    }

    public function approve(UpgradeRequest $upgradeRequest)
    {
        $user = $upgradeRequest->user;
        $role = $upgradeRequest->requested_role; // 'agent' or 'agency'

        $user->syncRoles(ucfirst($role));

        if ($role === 'agent') {
            // THE FIX: Find a default Agent Type
            $defaultAgentType = AgentType::first();
            if (!$defaultAgentType) {
                return back()->with('error', 'Cannot approve request: No Agent Types exist in the system. Please create one first.');
            }
            Agent::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'full_name' => $user->name,
                    'email' => $user->email,
                    'agent_type_id' => $defaultAgentType->id, // Assign the default type
                ]
            );
        } elseif ($role === 'agency') {
            // THE FIX: Find a default Agency Type
            $defaultAgencyType = AgencyType::first();
            if (!$defaultAgencyType) {
                return back()->with('error', 'Cannot approve request: No Agency Types exist in the system. Please create one first.');
            }
            Agency::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'agency_name' => ['en' => $user->name . ' Agency', 'ar' => 'وكالة ' . $user->name],
                    'email' => $user->email,
                    'agency_type_id' => $defaultAgencyType->id, // Assign the default type
                ]
            );
        }

        $upgradeRequest->update([
            'status' => 'approved',
            'processed_by' => Auth::id(),
            'processed_at' => now(),
        ]);

        Auth::user()->notifications()->where('data->request_id', $upgradeRequest->id)->first()?->markAsRead();

        return back()->with('success', "Request approved. User {$user->name} is now an {$role}.");
    }

    public function reject(Request $request, UpgradeRequest $upgradeRequest)
    {
         $upgradeRequest->update([
            'status' => 'rejected',
            'admin_notes' => $request->input('rejection_reason'),
            'processed_by' => Auth::id(),
            'processed_at' => now(),
        ]);

        Auth::user()->notifications()->where('data->request_id', $upgradeRequest->id)->first()?->markAsRead();

        return back()->with('success', 'Request has been rejected.');
    }
}
