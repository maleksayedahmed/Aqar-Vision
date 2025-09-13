<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\AgentInvitation;
use App\Notifications\AgentInvitationAcceptedNotification;
use App\Notifications\AgentInvitationRejectedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvitationController extends Controller
{
    public function accept(Request $request, AgentInvitation $invitation)
    {
        $agent = Auth::user()->agent;

        // Security checks
        if ($invitation->agent_id !== $agent->id || $invitation->status !== 'pending') {
            abort(403);
        }

        // Update invitation status
        $invitation->update(['status' => 'accepted']);

        // Assign agent to the agency
        $agent->agency_id = $invitation->agency_id;
        $agent->save();

        // Reject all other pending invitations for this agent
        $otherInvitations = \App\Models\AgentInvitation::where('agent_id', $agent->id)
            ->where('status', 'pending')
            ->where('id', '!=', $invitation->id)
            ->get();
        foreach ($otherInvitations as $other) {
            $other->update(['status' => 'rejected']);
            // Remove their notifications from the agent's notification list
            $request->user()->notifications()->where('data->invitation_id', $other->id)->delete();
        }

        // Mark the notification as read
        $notification = $request->user()->notifications()->where('data->invitation_id', $invitation->id)->first();
        if ($notification) {
            $notification->markAsRead();
        }

        // Notify the agency owner
        $agency = $invitation->agency;
        if ($agency && $agency->user) {
            $agency->user->notify(new AgentInvitationAcceptedNotification($invitation));
        }

        return redirect()->route('agent.home')->with('success', 'Invitation accepted successfully! You are now part of the agency.');
    }

    public function reject(Request $request, AgentInvitation $invitation)
    {
        $agent = Auth::user()->agent;

        // Security checks
        if ($invitation->agent_id !== $agent->id || $invitation->status !== 'pending') {
            abort(403);
        }

        // Update invitation status
        $invitation->update(['status' => 'rejected']);

        // Mark the notification as read
        $notification = $request->user()->notifications()->where('data->invitation_id', $invitation->id)->first();
        if ($notification) {
            $notification->markAsRead();
        }

        // Notify the agency owner
        $agency = $invitation->agency;
        if ($agency && $agency->user) {
            $agency->user->notify(new AgentInvitationRejectedNotification($invitation));
        }

        return redirect()->route('agent.home')->with('success', 'Invitation rejected successfully.');
    }
}
