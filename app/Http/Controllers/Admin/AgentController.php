<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AgentRequest;
use App\Models\Agent; // <-- We will use this directly in the index method
use App\Models\City;
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
     * THIS IS THE CORRECTED METHOD
     */
    public function index()
    {
        // Start the query directly on the Agent model to use eager loading
        $agents = Agent::with(['user', 'agentType', 'agency', 'city'])
                        ->latest() // Order by the newest agents first
                        ->paginate(15); // Paginate the results

        return view('admin.agents.index', compact('agents'));
    }

    public function create()
    {
        $users = $this->userRepository->all();
        $agentTypes = $this->agentTypeRepository->getActive();
        $agencies = $this->agencyRepository->all();
        $cities = City::where('is_active', true)->orderBy('name')->get();

        return view('admin.agents.create', compact('users', 'agentTypes', 'agencies', 'cities'));
    }

    public function store(AgentRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = auth()->id();
        $this->agentRepository->create($data);
        return redirect()->route('admin.agents.index')
            ->with('success', __('messages.created_successfully'));
    }

    public function edit(Agent $agent)
    {
        $agent->load('user', 'agentType', 'agency', 'city');
        $users = $this->userRepository->all();
        $agentTypes = $this->agentTypeRepository->getActive();
        $agencies = $this->agencyRepository->all();
        $cities = City::where('is_active', true)->orderBy('name')->get();

        return view('admin.agents.edit', compact('agent', 'users', 'agentTypes', 'agencies', 'cities'));
    }

    public function update(AgentRequest $request, Agent $agent)
    {
        $data = $request->validated();
        $data['updated_by'] = auth()->id();
        $this->agentRepository->update($agent->id, $data);
        return redirect()->route('admin.agents.index')
            ->with('success', __('messages.updated_successfully'));
    }

    public function destroy(Agent $agent)
    {
        $this->agentRepository->delete($agent->id);
        return redirect()->route('admin.agents.index')
            ->with('success', __('messages.deleted_successfully'));
    }
}