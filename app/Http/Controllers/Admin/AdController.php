<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\City;
use App\Models\District;
use App\Models\PropertyAttribute;
use App\Models\PropertyType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdController extends Controller
{
    /**
     * Display a listing of all ads with filtering capability.
     */
    public function index(Request $request): View
    {
        // Start query with eager loading to prevent N+1 issues
        $query = Ad::with(['user', 'district.city', 'propertyType']);

        // Apply filters if they are present in the request
        if ($request->filled('search')) {
            $query->where('title', 'LIKE', '%' . $request->search . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('city_id')) {
            $query->whereHas('district', fn($q) => $q->where('city_id', $request->city_id));
        }

        // Paginate the results and append query strings to pagination links
        $ads = $query->latest()->paginate(15)->withQueryString();
        
        // Get cities for the filter dropdown
        $cities = City::where('is_active', true)->orderBy('name')->get();

        return view('admin.ads.index', compact('ads', 'cities'));
    }

    /**
     * Show the form for creating a new ad.
     */
    public function create(): View
    {
        // Get data for form dropdowns
        $cities = City::where('is_active', true)->orderBy('name')->get();
        $propertyTypes = PropertyType::where('is_active', true)->whereNull('parent_id')->orderBy('name')->get();
        $users = User::where('is_active', true)->orderBy('name')->get();
        $features = PropertyAttribute::where('type', 'boolean')->orderBy('name->en')->get();

        return view('admin.ads.create', compact('cities', 'propertyTypes', 'users', 'features'));
    }

    /**
     * Store a newly created ad in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $this->validateAd($request);
        $validatedData['created_by'] = auth()->id();

        Ad::create($validatedData);

        return redirect()->route('admin.ads.index')->with('success', 'Ad created successfully.');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Ad $ad): View
    {
        return view('admin.ads.show', compact('ad'));
    }

    /**
     * Show the form for editing the specified ad.
     */
    public function edit(Ad $ad): View
    {
        $ad->load(['district.city', 'user']);

        // Get data for form dropdowns
        $cities = City::where('is_active', true)->orderBy('name')->get();
        $propertyTypes = PropertyType::where('is_active', true)->whereNull('parent_id')->orderBy('name')->get();
        $users = User::where('is_active', true)->orderBy('name')->get();
        $features = PropertyAttribute::where('type', 'boolean')->orderBy('name->en')->get();
        
        // Get districts for the currently selected city to pre-populate the dropdown
        $districts = [];
        if ($ad->district) {
            $districts = District::where('city_id', $ad->district->city_id)->orderBy('name')->get();
        }

        return view('admin.ads.edit', compact('ad', 'cities', 'propertyTypes', 'users', 'features', 'districts'));
    }

    /**
     * Update the specified ad in storage.
     */
    public function update(Request $request, Ad $ad): RedirectResponse
    {
        $validatedData = $this->validateAd($request);
        $validatedData['updated_by'] = auth()->id();

        $ad->update($validatedData);

        return redirect()->route('admin.ads.index')->with('success', 'Ad updated successfully.');
    }

    /**
     * Remove the specified ad from storage.
     */
    public function destroy(Ad $ad): RedirectResponse
    {
        $ad->delete();
        return redirect()->route('admin.ads.index')->with('success', 'Ad deleted successfully.');
    }

    /**
     * A private helper method to handle validation for both store and update.
     */
    private function validateAd(Request $request): array
{
    return $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'user_id' => 'required|exists:users,id',
        'status' => 'required|in:pending,active,rejected,expired',
        'district_id' => 'required|exists:districts,id',
        'property_type_id' => 'required|exists:property_types,id',
        'listing_purpose' => 'required|in:sale,rent',
        'total_price' => 'required|numeric|min:0',
        'area_sq_meters' => 'required|numeric|min:0',
        'rooms' => 'required|integer|min:0',
        'bathrooms' => 'required|integer|min:0',
        'age_years' => 'nullable|integer|min:0',
        'floor_number' => 'nullable|string|max:255',
        'province' => 'nullable|string|max:255',
        'street_name' => 'nullable|string|max:255',
        'finishing_status' => 'nullable|string|max:255',
        'facade' => 'nullable|string|max:255',
        'property_usage' => 'nullable|string|max:255',
        'plan_number' => 'nullable|string|max:255',
        'is_mortgaged' => 'required|boolean',
        'furniture_status' => 'nullable|string|max:255',
        'building_status' => 'nullable|string|max:255',
        'building_number' => 'nullable|string|max:255',
        'postal_code' => 'nullable|string|max:255',
        'features' => 'nullable|array',
        'latitude' => 'required|numeric|between:-90,90',
        'longitude' => 'required|numeric|between:-180,180',
    ]);
}
}