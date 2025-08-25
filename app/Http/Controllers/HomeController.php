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
        $cities = City::where('is_active', true)->orderBy('name')->get();
        $propertyTypes = PropertyType::where('is_active', true)->whereNull('parent_id')->orderBy('name')->get();

        // CORRECTED: Removed 'media' from the with() call
        $latestAds = Ad::where('status', 'active')
                       ->with(['district.city', 'propertyType'])
                       ->latest()
                       ->take(8)
                       ->get();

        $agents = User::whereHas('roles', function ($query) {
                        $query->where('name', 'agent');
                    })
                    ->where('is_active', true)
                    ->with(['agent.city'])
                    ->withCount('ads')
                    ->take(10)
                    ->get();

        return view('home', compact('cities', 'propertyTypes', 'latestAds', 'agents'));
    }
}