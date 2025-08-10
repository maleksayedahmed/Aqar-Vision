<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\City;
use App\Models\PropertyAttribute;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;

class PropertySearchController extends Controller
{
    /**
     * Handle the property search request and display the results.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        // Start with a query for active ads and eager load relationships for efficiency
        $query = Ad::where('status', 'active')->with(['district.city', 'propertyType']);

        // --- APPLY ALL FILTERS ---

        // Location Filters
        if ($request->filled('city_id')) {
            $query->whereHas('district', function ($q) use ($request) {
                $q->where('city_id', $request->city_id);
            });
        }
        if ($request->filled('district_id')) {
            $query->where('district_id', $request->district_id);
        }

        // Type and Purpose Filters
        if ($request->filled('property_type_id')) {
            $query->where('property_type_id', $request->property_type_id);
        }
        if ($request->filled('listing_purpose')) {
            $query->where('listing_purpose', $request->listing_purpose);
        }

        // Price Filter (handles ranges and open-ended values)
        if ($request->filled('price_range')) {
            $range = explode('-', $request->price_range);
            if (isset($range[1]) && is_numeric($range[1])) {
                $query->whereBetween('total_price', [$range[0], $range[1]]);
            } else {
                $query->where('total_price', '>=', $range[0]);
            }
        }
        
        // Rooms Filter (handles exact numbers and "5+")
        if ($request->filled('rooms')) {
            if (str_contains($request->rooms, '+')) {
                $query->where('rooms', '>=', (int)$request->rooms);
            } else {
                $query->where('rooms', '=', (int)$request->rooms);
            }
        }

        // Bathrooms Filter (handles exact numbers and "5+")
        if ($request->filled('bathrooms')) {
             if (str_contains($request->bathrooms, '+')) {
                $query->where('bathrooms', '>=', (int)$request->bathrooms);
            } else {
                $query->where('bathrooms', '=', (int)$request->bathrooms);
            }
        }
        
        // Area Filter (handles ranges and open-ended values)
        if ($request->filled('area_range')) {
             $range = explode('-', $request->area_range);
            if (isset($range[1]) && is_numeric($range[1])) {
                $query->whereBetween('area_sq_meters', [$range[0], $range[1]]);
            } else {
                $query->where('area_sq_meters', '>=', $range[0]);
            }
        }

        // Execute the query, order by latest, and paginate
        $ads = $query->latest()->paginate(12)->withQueryString();

        // Fetch data needed for the filter dropdowns on the results page
        $cities = City::where('is_active', true)->orderBy('name')->get();
        $propertyTypes = PropertyType::where('is_active', true)->whereNull('parent_id')->orderBy('name')->get();

        // Return the view with all necessary data
        return view('properties.index', [
            'ads' => $ads,
            'cities' => $cities,
            'propertyTypes' => $propertyTypes,
        ]);
    }

    /**
     * Display the specified ad (property) details page.
     *
     * @param Ad $ad
     * @return View
     */
    public function show(Ad $ad): View
    {
        // Eager load all necessary relationships for the detail page to optimize queries
        $ad->load(['user.agent.city', 'district.city', 'propertyType']);

        // Fetch all boolean attributes (features) to get their names AND icons.
        // We use keyBy() to create an associative array (e.g., ['pool' => {Attribute Object}])
        // which makes it very easy to look up in the Blade view.
        $features = PropertyAttribute::where('type', 'boolean')
            ->get()
            ->keyBy(fn ($item) => str_replace(' ', '_', strtolower($item->getTranslation('name', 'en'))));

        // Optional: Get a few "similar" ads to display at the bottom
        $similarAds = Ad::where('status', 'active')
                        ->where('id', '!=', $ad->id) // Exclude the current ad
                        ->where('district_id', $ad->district_id) // Example: similar ads in the same district
                        ->with(['district.city', 'propertyType'])
                        ->take(4)
                        ->get();

        return view('properties.show', [
            'ad' => $ad,
            'features' => $features, // Pass the features collection to the view
            'similarAds' => $similarAds
        ]);
    }
}