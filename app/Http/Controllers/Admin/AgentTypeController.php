<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AgentTypeRequest;
use App\Models\AgentType;
use App\Repositories\AgentTypeRepository;
use Illuminate\Http\Request;

class AgentTypeController extends Controller
{
    protected $agentTypeRepository;

    public function __construct(AgentTypeRepository $agentTypeRepository)
    {
        $this->agentTypeRepository = $agentTypeRepository;
    }

    public function index()
    {
        $agentTypes = $this->agentTypeRepository->paginate();
        return view('admin.agent-types.index', compact('agentTypes'));
    }

    public function create()
    {
        return view('admin.agent-types.create');
    }

    public function store(AgentTypeRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = auth()->id();
        $data['is_active'] = $request->has('is_active');
        $this->agentTypeRepository->create($data);
        return redirect()->route('admin.agent-types.index')
            ->with('success', __('attributes.agents.messages.created_successfully'));
    }

    public function edit(AgentType $agentType)
    {
        return view('admin.agent-types.edit', compact('agentType'));
    }

    public function update(AgentTypeRequest $request, AgentType $agentType)
    {
        $data = $request->validated();
        $data['updated_by'] = auth()->id();
        $data['is_active'] = $request->has('is_active');
        $this->agentTypeRepository->update($agentType->id, $data);
        return redirect()->route('admin.agent-types.index')
            ->with('success', __('attributes.agents.messages.updated_successfully'));
    }

    public function destroy(AgentType $agentType)
    {
        $this->agentTypeRepository->delete($agentType->id);
        return redirect()->route('admin.agent-types.index')
            ->with('success', __('attributes.agents.messages.deleted_successfully'));
    }

    public function toggleStatus($id)
    {
        $this->agentTypeRepository->toggleStatus($id);
        return redirect()->route('admin.agent-types.index')
            ->with('success', __('attributes.agents.messages.status_updated_successfully'));
    }
} 