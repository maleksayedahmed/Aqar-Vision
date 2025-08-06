<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Property;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str; // Import Str facade for text limiting

class PropertySearchController extends Controller
{
    /**
     * Handle the property search request and display the results.
     */
    public function index(Request $request): View
    {
        // Start with a query builder for the Property model, eager loading relationships
        $query = Property::with(['district.city', 'propertyType', 'media']);

        // Filter by City
        if ($request->filled('city_id')) {
            $query->whereHas('district', function ($q) use ($request) {
                $q->where('city_id', $request->city_id);
            });
        }

        // Filter by District
        if ($request->filled('district_id')) {
            $query->where('district_id', $request->district_id);
        }

        // Filter by Property Type
        if ($request->filled('property_type_id')) {
            $query->where('property_type_id', $request->property_type_id);
        }
        
        // Execute the query and paginate the results
        $properties = $query->latest()->paginate(12)->withQueryString(); // withQueryString appends filters to pagination links

        // Fetch data for the filter dropdowns on the results page
        $cities = City::where('is_active', true)->orderBy('name')->get();
        $propertyTypes = PropertyType::where('is_active', true)->whereNull('parent_id')->orderBy('name')->get();

        return view('properties.index', [
            'properties' => $properties,
            'cities' => $cities,
            'propertyTypes' => $propertyTypes,
        ]);
    }
}