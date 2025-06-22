<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AgencyTypeRequest;
use App\Models\AgencyType;
use App\Repositories\AgencyTypeRepository;
use Illuminate\Http\Request;

class AgencyTypeController extends Controller
{
    protected $agencyTypeRepository;

    public function __construct(AgencyTypeRepository $agencyTypeRepository)
    {
        $this->agencyTypeRepository = $agencyTypeRepository;
    }

    public function index()
    {
        $agencyTypes = $this->agencyTypeRepository->paginate();
        return view('admin.agency-types.index', compact('agencyTypes'));
    }

    public function create()
    {
        return view('admin.agency-types.create');
    }

    public function store(AgencyTypeRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = auth()->id();
        
        // This correctly handles the checkbox
        $data['is_active'] = $request->has('is_active');
        
        $this->agencyTypeRepository->create($data);
        
        return redirect()->route('admin.agency-types.index')
            ->with('success', __('messages.created_successfully'));
    }

    // Use Route Model Binding
    public function edit(AgencyType $agencyType)
    {
        return view('admin.agency-types.edit', compact('agencyType'));
    }

    // Use Route Model Binding
    public function update(AgencyTypeRequest $request, AgencyType $agencyType)
    {
        $data = $request->validated();
        $data['updated_by'] = auth()->id();

        // This correctly handles the checkbox
        $data['is_active'] = $request->has('is_active');
        
        $this->agencyTypeRepository->update($agencyType->id, $data);
        
        return redirect()->route('admin.agency-types.index')
            ->with('success', __('messages.updated_successfully'));
    }

    // Use Route Model Binding
    public function destroy(AgencyType $agencyType)
    {
        $this->agencyTypeRepository->delete($agencyType->id);
        return redirect()->route('admin.agency-types.index')
            ->with('success', __('messages.deleted_successfully'));
    }

    // This method is fine as-is because the repository handles the logic
    public function toggleStatus($id)
    {
        $this->agencyTypeRepository->toggleStatus($id);
        return redirect()->route('admin.agency-types.index')
            ->with('success', __('messages.status_updated_successfully'));
    }
}