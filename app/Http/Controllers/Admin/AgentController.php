<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AgentRequest;
use App\Models\Agent;
use App\Models\City;
use App\Models\User; // <-- IMPORT THE USER MODEL
use App\Repositories\AgentRepository;
use App\Repositories\AgentTypeRepository;
use App\Repositories\AgencyRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    protected $agentRepository;
    protected $agentTypeRepository;
    protected $agencyRepository;
    protected $userRepository;

    public function __construct(
        AgentRepository $agentRepository,
        AgentTypeRepository $agentTypeRepository,
        AgencyRepository $agencyRepository,
        UserRepository $userRepository
    ) {
        $this->agentRepository = $agentRepository;
        $this->agentTypeRepository = $agentTypeRepository;
        $this->agencyRepository = $agencyRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agents = Agent::with(['user', 'agentType', 'agency', 'city'])
                        ->latest()
                        ->paginate(15);

        return view('admin.agents.index', compact('agents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get only users who are NOT already agents to prevent duplicates
        $users = User::whereDoesntHave('agent')->orderBy('name')->get();
        $agentTypes = $this->agentTypeRepository->getActive();
        $agencies = $this->agencyRepository->all();
        $cities = City::where('is_active', true)->orderBy('name')->get();

        return view('admin.agents.create', compact('users', 'agentTypes', 'agencies', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AgentRequest $request)
    {
        $data = $request->validated();
        $user = User::findOrFail($data['user_id']);

        // Auto-fill details from the user model
        $data['full_name'] = $user->name;
        $data['email'] = $user->email;
        $data['phone_number'] = $user->phone;
        $data['created_by'] = auth()->id();

        $this->agentRepository->create($data);

        // ** THE FIX: Sync the user's role to 'agent' **
        // This removes any other roles and assigns 'agent'
        $user->syncRoles(['agent']);

        return redirect()->route('admin.agents.index')
            ->with('success', 'Agent created and user role updated successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agent $agent)
    {
        $agent->load('user', 'agentType', 'agency', 'city');
        
        // In edit mode, we show all users in case the admin wants to re-assign
        $users = $this->userRepository->all(); 
        $agentTypes = $this->agentTypeRepository->getActive();
        $agencies = $this->agencyRepository->all();
        $cities = City::where('is_active', true)->orderBy('name')->get();

        return view('admin.agents.edit', compact('agent', 'users', 'agentTypes', 'agencies', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AgentRequest $request, Agent $agent)
    {
        $data = $request->validated();
        $user = User::findOrFail($data['user_id']);

        // Auto-fill details from the user model
        $data['full_name'] = $user->name;
        $data['email'] = $user->email;
        $data['phone_number'] = $user->phone;
        $data['updated_by'] = auth()->id();
        
        // If the agent was re-assigned from another user, we should clean up the old user's role
        $oldUserId = $agent->user_id;
        if ($oldUserId !== $user->id) {
            $oldUser = User::find($oldUserId);
            if ($oldUser) {
                // Revert the old user to a default role, e.g., 'user'
                $oldUser->syncRoles(['user']); 
            }
        }
        
        $this->agentRepository->update($agent->id, $data);

        // ** THE FIX: Ensure the user's role is 'agent' **
        $user->syncRoles(['agent']);

        return redirect()->route('admin.agents.index')
            ->with('success', 'Agent updated and user role synchronized successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agent $agent)
    {
        // Find the user associated with this agent record BEFORE deleting it
        $user = $agent->user;

        $this->agentRepository->delete($agent->id);

        // ** THE FIX: Revert the user's role after deleting their agent profile **
        if ($user) {
            // Revert the user to a default role. Make sure you have a 'user' role.
            $user->syncRoles(['user']);
        }

        return redirect()->route('admin.agents.index')
            ->with('success', 'Agent deleted and user role reverted successfully.');
    }
}