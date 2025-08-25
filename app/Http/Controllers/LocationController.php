<?php

namespace App\Http\Controllers;

use App\Models\City; // <-- UPDATED: Import the City model
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Fetch districts based on the selected city ID.
     * This method is called by the JavaScript on the homepage.
     *
     * @param \App\Models\City $city
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDistrictsByCity(City $city): JsonResponse
    {
        // Laravel's Route Model Binding automatically finds the City by the ID passed in the URL.
        // We then fetch its related districts that are active and ordered by name.
        $districts = $city->districts()
                         ->where('is_active', true)
                         ->orderBy('name')
                         ->get(['id', 'name']); // Only select the ID and name columns

        // Return the districts as a JSON response
        return response()->json($districts);
    }
}