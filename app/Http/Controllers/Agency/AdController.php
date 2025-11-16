<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use Illuminate\Http\Request;

class AdController extends Controller
{
    /**
     * Display a listing of ads created by the agency's agents.
     */
    public function index(Request $request)
    {
        $agency = $request->user()->agency;
        
        // Get the user IDs of all agents belonging to this agency
        $agentUserIds = $agency->agents()->pluck('user_id');

        // Fetch ads where the user_id is in our list of agent IDs
        $adsQuery = Ad::whereIn('user_id', $agentUserIds)
                      ->with('user') // Eager load the user (agent) relationship
                      ->latest();
        
        // Optional: Add filters for the agency dashboard
        if ($request->filled('status')) {
            $adsQuery->where('status', $request->status);
        }

        $ads = $adsQuery->paginate(15)->withQueryString();
        
        return view('agency.ads.index', compact('ads'));
    }

    /**
     * Show the form for editing the specified ad.
     */
    public function edit(Request $request, Ad $ad)
    {
        // Security Check: Ensure this ad belongs to one of the agency's agents.
        if (!$ad->user || !$ad->user->agent || $ad->user->agent->agency_id !== $request->user()->agency->id) {
            abort(403);
        }
        
        // Here you would pass any necessary data for the edit form, like property types, etc.
        // For now, we will just pass the ad itself.
        return view('agency.ads.edit', compact('ad'));
    }

    /**
     * Update the specified ad in storage and set its status to pending.
     */
    public function update(Request $request, Ad $ad)
    {
        // Security Check
        if (!$ad->user || !$ad->user->agent || $ad->user->agent->agency_id !== $request->user()->agency->id) {
            abort(403);
        }

        // Validate the incoming data. This should match your main ad editing validation.
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            // Add other ad fields as needed for the edit form
        ]);

        // ** Business Logic: When an agency edits an ad, it must be re-approved by a site admin. **
        $updatePayload = array_merge($validatedData, ['status' => 'pending']);

        $ad->update($updatePayload);

        return redirect()->route('agency.ads.index')->with('success', 'Ad updated successfully and has been sent to the admin for re-approval.');
    }
}