<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyTypeRequest;
use App\Repositories\PropertyTypeRepository;
use Illuminate\Http\Request;

class PropertyTypeController extends Controller
{
    protected $propertyTypeRepository;

    public function __construct(PropertyTypeRepository $propertyTypeRepository)
    {
        $this->propertyTypeRepository = $propertyTypeRepository;
    }

    public function index()
    {
        $propertyTypes = $this->propertyTypeRepository->paginate();
        return view('admin.property-types.index', compact('propertyTypes'));
    }

    public function create()
    {
        return view('admin.property-types.create');
    }

    public function store(PropertyTypeRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = auth()->id();
        
        $this->propertyTypeRepository->create($data);
        
        return redirect()->route('admin.property-types.index')
            ->with('success', __('messages.created_successfully'));
    }

    public function edit($id)
    {
        $propertyType = $this->propertyTypeRepository->find($id);
        return view('admin.property-types.edit', compact('propertyType'));
    }

    public function update(PropertyTypeRequest $request, $id)
    {
        $data = $request->validated();
        $data['updated_by'] = auth()->id();
        
        $this->propertyTypeRepository->update($id, $data);
        
        return redirect()->route('admin.property-types.index')
            ->with('success', __('messages.updated_successfully'));
    }

    public function destroy($id)
    {
        $this->propertyTypeRepository->delete($id);
        return redirect()->route('admin.property-types.index')
            ->with('success', __('messages.deleted_successfully'));
    }

    public function toggleStatus($id)
    {
        $propertyType = $this->propertyTypeRepository->toggleStatus($id);
        return redirect()->route('admin.property-types.index')
            ->with('success', __('messages.status_updated_successfully'));
    }
} 