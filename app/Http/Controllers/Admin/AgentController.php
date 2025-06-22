<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AgentRequest;
use App\Models\Agent;
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

    public function index()
    {
        $agents = $this->agentRepository->paginate();
        return view('admin.agents.index', compact('agents'));
    }

    public function create()
    {
        $users = $this->userRepository->all();
        $agentTypes = $this->agentTypeRepository->getActive();
        $agencies = $this->agencyRepository->all();
        return view('admin.agents.create', compact('users', 'agentTypes', 'agencies'));
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
        $agent->load('user', 'agentType', 'agency');
        $users = $this->userRepository->all();
        $agentTypes = $this->agentTypeRepository->getActive();
        $agencies = $this->agencyRepository->all();
        return view('admin.agents.edit', compact('agent', 'users', 'agentTypes', 'agencies'));
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