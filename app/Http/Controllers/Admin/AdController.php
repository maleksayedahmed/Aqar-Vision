<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\City;
use App\Models\District;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Ad::with(['user', 'district.city', 'propertyType']);

        // Filtering logic
        if ($request->filled('search')) {
            $query->where('title', 'LIKE', '%' . $request->search . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('city_id')) {
            $query->whereHas('district', fn($q) => $q->where('city_id', $request->city_id));
        }

        $ads = $query->latest()->paginate(15)->withQueryString();
        $cities = City::where('is_active', true)->orderBy('name')->get();

        return view('admin.ads.index', compact('ads', 'cities'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ad $ad)
    {
        $cities = City::where('is_active', true)->orderBy('name')->get();
        $propertyTypes = PropertyType::where('is_active', true)->whereNull('parent_id')->orderBy('name')->get();
        // You might need to load districts if the city is pre-selected
        $districts = $ad->district ? District::where('city_id', $ad->district->city_id)->get() : [];

        return view('admin.ads.edit', compact('ad', 'cities', 'propertyTypes', 'districts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ad $ad)
    {
        // Validation can be expanded as needed
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|in:pending,active,rejected,expired',
            'district_id' => 'required|exists:districts,id',
            // Add other fields you want to be editable by the admin
        ]);

        $ad->update($validatedData);

        return redirect()->route('admin.ads.index')->with('success', 'Ad updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ad $ad)
    {
        $ad->delete();
        return redirect()->route('admin.ads.index')->with('success', 'Ad deleted successfully.');
    }
}