<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\PropertyType;
use App\Models\Ad;
use App\Models\User;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display the homepage.
     */
    public function index(): View
    {
        $cities = City::where('is_active', true)->orderBy('name')->get();
        $propertyTypes = PropertyType::where('is_active', true)->whereNull('parent_id')->orderBy('name')->get();

        // Query for "Latest Ads"
        $latestAds = Ad::where('status', 'active')
                       ->with(['district.city', 'propertyType'])
                       ->latest()
                       ->take(8)
                       ->get();

        // ** NEW QUERY for "Featured Ads" **
        // Fetches active ads that are linked to an AdPrice of type 'featured'.
        $featuredAds = Ad::where('status', 'active')
                        ->whereHas('adPrice', function ($query) {
                            $query->where('type', 'featured');
                        })
                        ->with(['district.city', 'propertyType'])
                        ->latest()
                        ->take(4) // Let's show fewer featured ads to make them special
                        ->get();

        // Query for Agents
        $agents = User::whereHas('roles', function ($query) {
                        $query->where('name', 'agent');
                    })
                    ->where('is_active', true)
                    ->with(['agent.city'])
                    ->withCount('ads')
                    ->take(10)
                    ->get();

        // Get user's favorite ad IDs if authenticated
        $favoriteAdIds = [];
        if (Auth::check()) {
            $favoriteAdIds = Favorite::where('user_id', Auth::id())->pluck('ad_id')->toArray();
        }

        // Pass the new $featuredAds variable to the view
        return view('home', compact('cities', 'propertyTypes', 'latestAds', 'featuredAds', 'agents', 'favoriteAdIds'));
    }

    public function allAgents(): View
    {
        $agents = User::whereHas('roles', function ($query) {
            $query->where('name', 'agent');
        })
        ->where('is_active', true)
        ->with(['agent.city'])
        ->withCount('ads')
        ->get();

        return view('all-agents', compact('agents'));
    }

    public function contactUs(): View
    {
        return view('contact-us');
    }
}
