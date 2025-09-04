<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\User;
use App\Models\City;
use App\Models\AgentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AgentController extends Controller
{
    /**
     * Display a listing of the agency's agents.
     */
    public function index(Request $request)
    {
        $agency = $request->user()->agency;
        $agents = $agency->agents()->with('user')->latest()->paginate(10);

        return view('agency.agents.index', compact('agents'));
    }

    /**
     * Show the form for creating a new agent under the agency.
     */
    public function create()
    {
        $agentTypes = AgentType::where('is_active', true)->get();
        $cities = City::where('is_active', true)->get();

        return view('agency.agents.create', compact('agentTypes', 'cities'));
    }

    /**
     * Store a newly created agent in storage.
     */
    public function store(Request $request)
    {
        $agency = $request->user()->agency;

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'agent_type_id' => ['required', 'exists:agent_types,id'],
            'city_id' => ['required', 'exists:cities,id'],
            'license_number' => ['nullable', 'string', 'max:255'],
        ]);

        // 1. Create the User record for the agent
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'is_active' => true, // Agents created by agencies are active by default
        ]);

        // 2. Assign the 'agent' role to the new user
        $user->assignRole('agent');

        // 3. Create the Agent profile and associate it with both the new user and the agency
        $agency->agents()->create([
            'user_id' => $user->id,
            'full_name' => $user->name,
            'email' => $user->email,
            'phone_number' => $user->phone,
            'agent_type_id' => $request->agent_type_id,
            'city_id' => $request->city_id,
            'license_number' => $request->license_number,
            'created_by' => auth()->id(),
        ]);
        
        return redirect()->route('agency.agents.index')->with('success', 'Agent created successfully.');
    }

    /**
     * Show the form for editing the specified agent.
     */
    public function edit(Request $request, Agent $agent)
    {
        // Security Check: Ensure the agent belongs to the logged-in agency
        if ($agent->agency_id !== $request->user()->agency->id) {
            abort(403);
        }
        
        $agent->load('user');
        $agentTypes = AgentType::where('is_active', true)->get();
        $cities = City::where('is_active', true)->get();

        return view('agency.agents.edit', compact('agent', 'agentTypes', 'cities'));
    }

    /**
     * Update the specified agent in storage.
     */
    public function update(Request $request, Agent $agent)
    {
        // Security Check: Ensure the agent belongs to the logged-in agency
        if ($agent->agency_id !== $request->user()->agency->id) {
            abort(403);
        }

        $user = $agent->user; // Get the associated user

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'agent_type_id' => ['required', 'exists:agent_types,id'],
            'city_id' => ['required', 'exists:cities,id'],
            'license_number' => ['nullable', 'string', 'max:255'],
        ]);

        // 1. Update the User record
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }
        $user->update($userData);

        // 2. Update the Agent profile
        $agent->update([
            'full_name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone,
            'agent_type_id' => $request->agent_type_id,
            'city_id' => $request->city_id,
            'license_number' => $request->license_number,
            'updated_by' => auth()->id(),
        ]);

        return redirect()->route('agency.agents.index')->with('success', 'Agent updated successfully.');
    }

    /**
     * Remove the specified agent from storage.
     */
    public function destroy(Request $request, Agent $agent)
    {
        // Security Check: Ensure the agent belongs to the logged-in agency
        if ($agent->agency_id !== $request->user()->agency->id) {
            abort(403);
        }
        
        // Deleting the user will also delete the agent via database constraints/observers
        if ($agent->user) {
            $agent->user->delete();
        } else {
            // Fallback if user was already deleted somehow
            $agent->delete();
        }

        return redirect()->route('agency.agents.index')->with('success', 'Agent deleted successfully.');
    }
}