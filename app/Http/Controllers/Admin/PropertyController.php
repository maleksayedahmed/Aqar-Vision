<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PropertyRequest;
use App\Models\Property;
use App\Models\PropertyPurpose;
use App\Models\PropertyType;
use App\Models\User;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::with('propertyType', 'user')->latest()->paginate(15);
        return view('admin.properties.index', compact('properties'));
    }

    public function create()
    {
        $purposes = PropertyPurpose::where('is_active', true)->get();
        $types = PropertyType::where('is_active', true)->get();
        $users = User::where('is_active', true)->get();

        return view('admin.properties.create', compact('purposes', 'types', 'users'));
    }

    public function store(PropertyRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = auth()->id();
        $data['created_by'] = auth()->id();

        $data['services'] = $request->input('attributes', []);

        Property::create($data);

        return redirect()->route('admin.properties.index')->with('success', 'Property created successfully.');
    }

    public function show(Property $property)
    {
        return view('admin.properties.show', compact('property'));
    }

    public function edit(Property $property)
    {
        $purposes = PropertyPurpose::where('is_active', true)->get();
        $types = PropertyType::where('is_active', true)->get();
        $users = User::where('is_active', true)->get();

        return view('admin.properties.edit', compact('property', 'purposes', 'types', 'users'));
    }

    public function update(PropertyRequest $request, Property $property)
    {
        $data = $request->validated();
        $data['updated_by'] = auth()->id();
        $data['services'] = $request->input('attributes', []);

        $property->update($data);

        return redirect()->route('admin.properties.index')->with('success', 'Property updated successfully.');
    }

    public function destroy(Property $property)
    {
        $property->delete();
        return redirect()->route('admin.properties.index')->with('success', 'Property deleted successfully.');
    }
}
