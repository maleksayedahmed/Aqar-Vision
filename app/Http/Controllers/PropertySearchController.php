<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\City;
use App\Models\PropertyAttribute;
use App\Models\PropertyType;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;

class PropertySearchController extends Controller
{
    /**
     * Display the property search results in a list format.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        // Start the base query for active ads and eager load necessary relationships
        $query = Ad::where('status', 'active')->with(['district.city', 'propertyType']);

        // Apply all the filters from the request using the helper method
        $this->applyFilters($request, $query);

        // Execute the query, order by the latest, and paginate the results
        $ads = $query->latest()->paginate(12)->withQueryString();

        // Get data for the filter dropdowns on the results page
        $cities = City::where('is_active', true)->orderBy('name')->get();
        $propertyTypes = PropertyType::where('is_active', true)->whereNull('parent_id')->orderBy('name')->get();

        return view('properties.index', [
            'ads' => $ads,
            'cities' => $cities,
            'propertyTypes' => $propertyTypes,
        ]);
    }

    /**
     * Display the property search results on a map.
     *
     * @param Request $request
     * @return View
     */
    public function map(Request $request): View
    {
        // Start the base query for active ads
        $query = Ad::where('status', 'active')->with(['district.city', 'propertyType']);

        // Apply all the filters from the request using the helper method
        $this->applyFilters($request, $query);

        // ** THIS IS THE MODIFIED LINE **
        // For the map, we now get the 'images' column as well.
        $allAdsForMap = (clone $query)->get(['id', 'title', 'latitude', 'longitude', 'total_price', 'images']);

        // For the cards below the map, we get a PAGINATED list of the first 4 results.
        // We clone the query to start fresh before adding pagination.
        $paginatedAds = (clone $query)->latest()->paginate(4)->withQueryString();

        // Get data for the filter dropdowns
        $cities = City::where('is_active', true)->orderBy('name')->get();
        $propertyTypes = PropertyType::where('is_active', true)->whereNull('parent_id')->orderBy('name')->get();

        return view('properties.map', [
            'allAdsForMap' => $allAdsForMap, // This is for the map markers
            'ads' => $paginatedAds,          // This is for the cards and pagination links
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
        $features = PropertyAttribute::where('type', 'boolean')
            ->get()
            ->keyBy(fn ($item) => str_replace(' ', '_', strtolower($item->getTranslation('name', 'en'))));

        // Optional: Get a few "similar" ads to display at the bottom
        $similarAds = Ad::where('status', 'active')
                        ->where('id', '!=', $ad->id)
                        ->where('district_id', $ad->district_id)
                        ->with(['district.city', 'propertyType'])
                        ->take(4)
                        ->get();

        return view('properties.show', [
            'ad' => $ad,
            'features' => $features,
            'similarAds' => $similarAds
        ]);
    }

    /**
     * Display the specified agent's public profile and listings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $agent
     * @return \Illuminate\View\View
     */
    public function showAgent(Request $request, User $agent)
    {
        // Ensure the user is a valid, active agent
        if (!$agent->hasRole('agent') || !$agent->is_active) {
            abort(404, 'Agent not found or is inactive.');
        }

        $agent->load(['agent.city']);

        // Get the sort option from the URL, default to 'latest' if not present
        $sortBy = $request->input('sort', 'latest');

        // Set a default display text
        $sortText = 'الأحدث';

        // Start the query to get the agent's ads
        $adsQuery = $agent->ads()
                         ->where('status', 'active')
                         ->with(['district.city', 'propertyType']);

        // Apply sorting based on the 'sortBy' parameter
        switch ($sortBy) {
            case 'price_asc':
                $adsQuery->orderBy('total_price', 'asc');
                $sortText = 'السعر: من الأقل للأعلى';
                break;
            case 'price_desc':
                $adsQuery->orderBy('total_price', 'desc');
                $sortText = 'السعر: من الأعلى للأقل';
                break;
            case 'oldest':
                $adsQuery->orderBy('created_at', 'asc');
                $sortText = 'الأقدم';
                break;
            default: // 'latest'
                $adsQuery->latest();
                break;
        }

        // Paginate the sorted results and keep the sort parameter in the pagination links
        $ads = $adsQuery->paginate(8)->withQueryString();

        // Pass the new sorting variables to the view
        return view('agent-show', compact('agent', 'ads', 'sortBy', 'sortText'));
    }

    /**
     * A private helper method to apply all common search filters to a query.
     *
     * @param Request $request
     * @param Builder $query
     * @return void
     */
    private function applyFilters(Request $request, Builder $query): void
    {
        // Location Filters
        if ($request->filled('city_id')) {
            $query->whereHas('district', fn($q) => $q->where('city_id', $request->city_id));
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

        // Price Filter
        if ($request->filled('price_range')) {
            $range = explode('-', $request->price_range);
            if (isset($range[1]) && is_numeric($range[1])) {
                $query->whereBetween('total_price', [$range[0], $range[1]]);
            } else {
                $query->where('total_price', '>=', $range[0]);
            }
        }

        // Rooms Filter
        if ($request->filled('rooms')) {
            if (str_contains($request->rooms, '+')) {
                $query->where('rooms', '>=', (int)$request->rooms);
            } else {
                $query->where('rooms', '=', (int)$request->rooms);
            }
        }

        // Bathrooms Filter
        if ($request->filled('bathrooms')) {
             if (str_contains($request->bathrooms, '+')) {
                $query->where('bathrooms', '>=', (int)$request->bathrooms);
            } else {
                $query->where('bathrooms', '=', (int)$request->bathrooms);
            }
        }

        // Area Filter
        if ($request->filled('area_range')) {
             $range = explode('-', $request->area_range);
            if (isset($range[1]) && is_numeric($range[1])) {
                $query->whereBetween('area_sq_meters', [$range[0], $range[1]]);
            } else {
                $query->where('area_sq_meters', '>=', $range[0]);
            }
        }
    }
}