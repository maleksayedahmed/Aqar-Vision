<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PropertyAttributeRequest;
use App\Models\PropertyAttribute;

class PropertyAttributeController extends Controller
{
    public function index()
    {
        $attributes = PropertyAttribute::latest()->paginate(15);
        return view('admin.property-attributes.index', compact('attributes'));
    }

    public function create()
    {
        return view('admin.property-attributes.create');
    }

    public function store(PropertyAttributeRequest $request)
    {
        PropertyAttribute::create($request->validated());

        return redirect()->route('admin.property-attributes.index')
            ->with('success', __('messages.created_successfully'));
    }

    public function edit(PropertyAttribute $propertyAttribute)
    {
        return view('admin.property-attributes.edit', compact('propertyAttribute'));
    }

    public function update(PropertyAttributeRequest $request, PropertyAttribute $propertyAttribute)
    {
        $propertyAttribute->update($request->validated());

        return redirect()->route('admin.property-attributes.index')
            ->with('success', __('messages.updated_successfully'));
    }

    public function destroy(PropertyAttribute $propertyAttribute)
    {
        // Optional: Check if attribute is in use before deleting
        if ($propertyAttribute->propertyTypes()->exists()) {
            return redirect()->route('admin.property-attributes.index')
                ->with('error', 'Cannot delete attribute as it is assigned to one or more property types.');
        }

        $propertyAttribute->delete();

        return redirect()->route('admin.property-attributes.index')
            ->with('success', __('messages.deleted_successfully'));
    }
}