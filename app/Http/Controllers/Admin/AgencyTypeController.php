<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AgencyTypeRequest;
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
        
        $this->agencyTypeRepository->create($data);
        
        return redirect()->route('admin.agency-types.index')
            ->with('success', __('messages.created_successfully'));
    }

    public function edit($id)
    {
        $agencyType = $this->agencyTypeRepository->find($id);
        return view('admin.agency-types.edit', compact('agencyType'));
    }

    public function update(AgencyTypeRequest $request, $id)
    {
        $data = $request->validated();
        $data['updated_by'] = auth()->id();
        
        $this->agencyTypeRepository->update($id, $data);
        
        return redirect()->route('admin.agency-types.index')
            ->with('success', __('messages.updated_successfully'));
    }

    public function destroy($id)
    {
        $this->agencyTypeRepository->delete($id);
        return redirect()->route('admin.agency-types.index')
            ->with('success', __('messages.deleted_successfully'));
    }

    public function toggleStatus($id)
    {
        $agencyType = $this->agencyTypeRepository->toggleStatus($id);
        return redirect()->route('admin.agency-types.index')
            ->with('success', __('messages.status_updated_successfully'));
    }
} 