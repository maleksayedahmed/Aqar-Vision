<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyTypeRequest;
use App\Models\PropertyAttribute;
use App\Models\PropertyType;
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
        $parentTypes = PropertyType::whereNull('parent_id')->orderBy('name')->get();
        $attributes = PropertyAttribute::orderBy('name')->get();
        return view('admin.property-types.create', compact('parentTypes', 'attributes'));
    }

    public function store(PropertyTypeRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = auth()->id();
        $data['is_active'] = $request->has('is_active');

        $propertyType = $this->propertyTypeRepository->create($data);

        $attributesToSync = array_filter($request->input('attributes', []));
        $propertyType->attributes()->sync($attributesToSync);

        return redirect()->route('admin.property-types.index')
            ->with('success', __('messages.created_successfully'));
    }

    public function edit(PropertyType $propertyType)
    {
        $parentTypes = PropertyType::whereNull('parent_id')->where('id', '!=', $propertyType->id)->orderBy('name')->get();
        $attributes = PropertyAttribute::orderBy('name')->get();
        $selectedAttributes = $propertyType->attributes->pluck('id')->toArray();

        return view('admin.property-types.edit', compact('propertyType', 'parentTypes', 'attributes', 'selectedAttributes'));
    }

    public function update(PropertyTypeRequest $request, PropertyType $propertyType)
    {
        
        $data = $request->validated();
        $data['updated_by'] = auth()->id();
        $data['is_active'] = $request->has('is_active');

        $this->propertyTypeRepository->update($propertyType->id, $data);

        $attributesToSync = array_filter($request->input('attributes', []));
        $propertyType->attributes()->sync($attributesToSync);

        return redirect()->route('admin.property-types.index')
            ->with('success', __('messages.updated_successfully'));
    }

    public function destroy(PropertyType $propertyType)
    {
        $this->propertyTypeRepository->delete($propertyType->id);
        return redirect()->route('admin.property-types.index')
            ->with('success', __('messages.deleted_successfully'));
    }

    public function toggleStatus(PropertyType $propertyType)
    {
        $this->propertyTypeRepository->toggleStatus($propertyType->id);
        return redirect()->route('admin.property-types.index')
            ->with('success', __('messages.status_updated_successfully'));
    }
    public function getAttributes(PropertyType $propertyType)
    {
        return response()->json($propertyType->load('attributes')->attributes);
    }
}
