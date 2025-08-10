<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\City;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;

class PropertySearchController extends Controller
{
    public function index(Request $request): View
{
    $query = Ad::where('status', 'active')->with(['district.city', 'propertyType']);

    // --- APPLY FILTERS ---
    if ($request->filled('city_id')) {
        $query->whereHas('district', fn($q) => $q->where('city_id', $request->city_id));
    }
    if ($request->filled('district_id')) {
        $query->where('district_id', $request->district_id);
    }
    if ($request->filled('property_type_id')) {
        $query->where('property_type_id', $request->property_type_id);
    }
    if ($request->filled('listing_purpose')) {
        $query->where('listing_purpose', $request->listing_purpose);
    }

    // UPDATED: Price Filter
    if ($request->filled('price_range')) {
        $range = explode('-', $request->price_range);
        if (isset($range[1]) && is_numeric($range[1])) {
            $query->whereBetween('total_price', [$range[0], $range[1]]);
        } else {
            $query->where('total_price', '>=', $range[0]);
        }
    }
    
    // UPDATED: Rooms Filter
    if ($request->filled('rooms')) {
        if (str_contains($request->rooms, '+')) {
            $query->where('rooms', '>=', (int)$request->rooms);
        } else {
            $query->where('rooms', '=', (int)$request->rooms);
        }
    }

    // UPDATED: Bathrooms Filter
    if ($request->filled('bathrooms')) {
         if (str_contains($request->bathrooms, '+')) {
            $query->where('bathrooms', '>=', (int)$request->bathrooms);
        } else {
            $query->where('bathrooms', '=', (int)$request->bathrooms);
        }
    }
    
    // UPDATED: Area Filter
    if ($request->filled('area_range')) {
         $range = explode('-', $request->area_range);
        if (isset($range[1]) && is_numeric($range[1])) {
            $query->whereBetween('area_sq_meters', [$range[0], $range[1]]);
        } else {
            $query->where('area_sq_meters', '>=', $range[0]);
        }
    }

    $ads = $query->latest()->paginate(12)->withQueryString();

    $cities = City::where('is_active', true)->orderBy('name')->get();
    $propertyTypes = PropertyType::where('is_active', true)->whereNull('parent_id')->orderBy('name')->get();

    return view('properties.index', compact('ads', 'cities', 'propertyTypes'));
}
}