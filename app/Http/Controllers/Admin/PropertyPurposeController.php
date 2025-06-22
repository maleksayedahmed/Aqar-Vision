<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyPurposeRequest;
use App\Models\PropertyPurpose;
use App\Repositories\PropertyPurposeRepository;
use Illuminate\Http\Request;

class PropertyPurposeController extends Controller
{
    protected $propertyPurposeRepository;

    public function __construct(PropertyPurposeRepository $propertyPurposeRepository)
    {
        $this->propertyPurposeRepository = $propertyPurposeRepository;
    }

    public function index()
    {
        $propertyPurposes = $this->propertyPurposeRepository->paginate();
        return view('admin.property-purposes.index', compact('propertyPurposes'));
    }

    public function create()
    {
        return view('admin.property-purposes.create');
    }

    public function store(PropertyPurposeRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = auth()->id();
        $data['is_active'] = $request->has('is_active');
        
        $this->propertyPurposeRepository->create($data);
        
        return redirect()->route('admin.property-purposes.index')
            ->with('success', __('messages.created_successfully'));
    }

    public function edit(PropertyPurpose $propertyPurpose)
    {
        return view('admin.property-purposes.edit', compact('propertyPurpose'));
    }

    public function update(PropertyPurposeRequest $request, PropertyPurpose $propertyPurpose)
    {
        $data = $request->validated();
        $data['updated_by'] = auth()->id();
        $data['is_active'] = $request->has('is_active');
        
        $this->propertyPurposeRepository->update($propertyPurpose->id, $data);
        
        return redirect()->route('admin.property-purposes.index')
            ->with('success', __('messages.updated_successfully'));
    }

    public function destroy(PropertyPurpose $propertyPurpose)
    {
        $this->propertyPurposeRepository->delete($propertyPurpose->id);
        return redirect()->route('admin.property-purposes.index')
            ->with('success', __('messages.deleted_successfully'));
    }

    public function toggleStatus(PropertyPurpose $propertyPurpose)
    {
        $this->propertyPurposeRepository->toggleStatus($propertyPurpose->id);
        return redirect()->route('admin.property-purposes.index')
            ->with('success', __('messages.status_updated_successfully'));
    }
}