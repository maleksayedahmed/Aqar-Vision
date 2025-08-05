<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\JsonResponse;

class LocationController extends Controller
{
    /**
     * Get the cities for a given country.
     *
     * @param \App\Models\Country $country
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCities(Country $country): JsonResponse
    {
        // Fetch only active cities for the selected country, ordered by name
        $cities = $country->cities()->where('is_active', true)->orderBy('name')->get(['id', 'name']);

        return response()->json($cities);
    }
}