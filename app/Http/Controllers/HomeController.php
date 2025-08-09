<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\PropertyType;
use App\Models\Ad; 
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the homepage.
     */
    public function index(): View
    {
        // 1. Fetch data for the search form dropdowns
        $cities = City::where('is_active', true)->orderBy('name')->get();
        $propertyTypes = PropertyType::where('is_active', true)->whereNull('parent_id')->orderBy('name')->get();

        // 2. Fetch the latest active ads for the "Latest Properties" slider
        $latestAds = Ad::where('status', 'active')
                       ->with(['district.city', 'propertyType', 'media']) // Eager load relationships
                       ->latest() // Order by the latest created
                       ->take(8)  // Limit to 8 results for the slider
                       ->get();

        // 3. Fetch users who are agents for the "Real Estate Agents" slider
        $agents = User::whereHas('roles', function ($query) {
                        $query->where('name', 'agent');
                    })
                    ->where('is_active', true)
                    ->withCount('ads') // Count how many ads each agent has
                    ->take(10) // Limit to 10 agents for the slider
                    ->get();

        // 4. Pass all data to the view
        return view('home', compact('cities', 'propertyTypes', 'latestAds', 'agents'));
    }
}