<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PropertyRequest;
use App\Models\City;
use App\Models\District;
use App\Models\Property;
use App\Models\PropertyPurpose;
use App\Models\PropertyType;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        // Load relationships to prevent N+1 issues
        $query = Property::with(['propertyType', 'user', 'district.city']);

        if ($request->filled('search')) {
            $query->where('title', 'LIKE', '%' . $request->search . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('property_type_id')) {
            $query->where('property_type_id', $request->property_type_id);
        }
        if ($request->filled('city_id')) {
            $query->whereHas('district', function ($q) use ($request) {
                $q->where('city_id', $request->city_id);
            });
        }

        $properties = $query->latest()->paginate(15)->withQueryString();
        $propertyTypes = PropertyType::where('is_active', true)->orderBy('name')->get();
        $cities = City::where('is_active', true)->orderBy('name')->get(); // For the filter dropdown

        return view('admin.properties.index', compact('properties', 'propertyTypes', 'cities'));
    }

    public function create()
    {
        $purposes = PropertyPurpose::where('is_active', true)->get();
        $types = PropertyType::where('is_active', true)->get();
        $users = User::where('is_active', true)->get();
        $cities = City::where('is_active', true)->orderBy('name')->get(); // <-- ADD THIS

        return view('admin.properties.create', compact('purposes', 'types', 'users', 'cities'));
    }

    public function store(PropertyRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = auth()->id();
        $data['created_by'] = auth()->id();
        $data['services'] = $request->input('attributes', []);

        $property = Property::create($data);

        if ($request->hasFile('photos')) {
            $property->addMultipleMediaFromRequest(['photos'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('property_images');
            });
        }

        return redirect()->route('admin.properties.edit', $property)->with('success', 'Property created successfully.');
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
        $cities = City::where('is_active', true)->orderBy('name')->get(); // <-- ADD THIS

        return view('admin.properties.edit', compact('property', 'purposes', 'types', 'users', 'cities'));
    }

    public function update(PropertyRequest $request, Property $property)
    {
        $data = $request->validated();
        $data['updated_by'] = auth()->id();
        $data['services'] = $request->input('attributes', []);

        $property->update($data);

        if ($request->hasFile('photos')) {
            $property->addMultipleMediaFromRequest(['photos'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('property_images');
            });
        }

        return redirect()->route('admin.properties.edit', $property)->with('success', 'Property updated successfully.');
    }

    public function destroy(Property $property)
    {
        $property->delete();
        return redirect()->route('admin.properties.index')->with('success', 'Property deleted successfully.');
    }

    public function destroyMedia(Property $property, Media $media)
    {
        $media->delete();
        return back()->with('success', 'Image deleted successfully.');
    }
}