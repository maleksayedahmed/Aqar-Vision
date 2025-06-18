<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyPurposeRequest;
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
        
        $this->propertyPurposeRepository->create($data);
        
        return redirect()->route('admin.property-purposes.index')
            ->with('success', __('messages.created_successfully'));
    }

    public function edit($id)
    {
        $propertyPurpose = $this->propertyPurposeRepository->find($id);
        return view('admin.property-purposes.edit', compact('propertyPurpose'));
    }

    public function update(PropertyPurposeRequest $request, $id)
    {
        $data = $request->validated();
        $data['updated_by'] = auth()->id();
        
        $this->propertyPurposeRepository->update($id, $data);
        
        return redirect()->route('admin.property-purposes.index')
            ->with('success', __('messages.updated_successfully'));
    }

    public function destroy($id)
    {
        $this->propertyPurposeRepository->delete($id);
        return redirect()->route('admin.property-purposes.index')
            ->with('success', __('messages.deleted_successfully'));
    }

    public function toggleStatus($id)
    {
        $propertyPurpose = $this->propertyPurposeRepository->toggleStatus($id);
        return redirect()->route('admin.property-purposes.index')
            ->with('success', __('messages.status_updated_successfully'));
    }
} 