<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\PropertyPurpose;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $properties = Property::where(function($query) use ($user) {
            $query->where('user_id', $user->id)
                  ->orWhere('agent_id', $user->agent?->id);
        })->with(['propertyType', 'purpose'])->get();
        $favoriteAdIds = [];
        if (Auth::check()) {
            $favoriteAdIds = Favorite::where('user_id', Auth::id())->pluck('ad_id')->toArray();
        }
        return view('properties.index', compact('properties', 'favoriteAdIds'));
    }

    public function create()
    {
        $propertyTypes = PropertyType::where('is_active', true)->get();
        $propertyPurposes = PropertyPurpose::where('is_active', true)->get();
        return view('properties.create', compact('propertyTypes', 'propertyPurposes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'city' => 'required|string|max:255',
            'neighborhood' => 'required|string|max:255',
            'street_width' => 'nullable|numeric|min:0',
            'facade' => 'nullable|string|max:255',
            'area_sq_meters' => 'required|numeric|min:0',
            'purpose_id' => 'required|exists:property_purposes,id',
            'price_per_unit' => 'nullable|numeric|min:0',
            'total_price' => 'required|numeric|min:0',
            'property_type_id' => 'required|exists:property_types,id',
            'age_years' => 'nullable|integer|min:0',
            'services' => 'nullable|array',
            'listing_purpose' => 'required|in:sale,rent',
            'contact_number' => 'required|string|max:20',
            'encumbrances' => 'nullable|string',
        ]);

        $user = Auth::user();

        try {
            DB::beginTransaction();

            $property = Property::create([
                ...$validated,
                'user_id' => $user->id,
                'agent_id' => $user->agent?->id,
                'created_by' => $user->id,
                'updated_by' => $user->id
            ]);

            DB::commit();

            return redirect()->route('properties.index')
                ->with('success', 'Property created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to create property. Please try again.');
        }
    }

    public function show(Property $property)
    {
        $user = Auth::user();
        if ($property->user_id !== $user->id && $property->agent_id !== $user->agent?->id) {
            abort(403);
        }

        return view('properties.show', compact('property'));
    }

    public function edit(Property $property)
    {
        $user = Auth::user();
        if ($property->user_id !== $user->id && $property->agent_id !== $user->agent?->id) {
            abort(403);
        }

        $propertyTypes = PropertyType::where('is_active', true)->get();
        $propertyPurposes = PropertyPurpose::where('is_active', true)->get();

        return view('properties.edit', compact('property', 'propertyTypes', 'propertyPurposes'));
    }

    public function update(Request $request, Property $property)
    {
        $user = Auth::user();
        if ($property->user_id !== $user->id && $property->agent_id !== $user->agent?->id) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'city' => 'required|string|max:255',
            'neighborhood' => 'required|string|max:255',
            'street_width' => 'nullable|numeric|min:0',
            'facade' => 'nullable|string|max:255',
            'area_sq_meters' => 'required|numeric|min:0',
            'purpose_id' => 'required|exists:property_purposes,id',
            'price_per_unit' => 'nullable|numeric|min:0',
            'total_price' => 'required|numeric|min:0',
            'property_type_id' => 'required|exists:property_types,id',
            'age_years' => 'nullable|integer|min:0',
            'services' => 'nullable|array',
            'listing_purpose' => 'required|in:sale,rent',
            'contact_number' => 'required|string|max:20',
            'encumbrances' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $property->update([
                ...$validated,
                'updated_by' => $user->id
            ]);

            DB::commit();

            return redirect()->route('properties.index')
                ->with('success', 'Property updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to update property. Please try again.');
        }
    }

    public function destroy(Property $property)
    {
        $user = Auth::user();
        if ($property->user_id !== $user->id && $property->agent_id !== $user->agent?->id) {
            abort(403);
        }

        try {
            DB::beginTransaction();

            $property->delete();

            DB::commit();

            return redirect()->route('properties.index')
                ->with('success', 'Property deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to delete property. Please try again.');
        }
    }
}
