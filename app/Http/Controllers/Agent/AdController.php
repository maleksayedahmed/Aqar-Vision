<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\AdPrice;
use App\Models\City;
use App\Models\PropertyAttribute;
use App\Models\PropertyType;
use App\Models\Subscription; // <-- IMPORTED Subscription model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdController extends Controller
{
    /**
     * Display a listing of the agent's ads.
     */
    public function index(Request $request)
    {
        $userId = Auth::id();
        $tab = $request->query('tab', 'active');
        $baseQuery = Ad::where('user_id', $userId);

        $activeCount = (clone $baseQuery)->where('status', 'active')->count();
        $pendingCount = (clone $baseQuery)->where('status', 'pending')->count();
        $deletedCount = (clone $baseQuery)->onlyTrashed()->count();
        $expiredCount = (clone $baseQuery)->where('status', 'expired')->count();

        $query = Ad::where('user_id', $userId)->with('district.city', 'propertyType')->latest();

        switch ($tab) {
            case 'pending': $query->where('status', 'pending'); break;
            case 'deleted': $query->onlyTrashed(); break;
            case 'expired': $query->where('status', 'expired'); break;
            case 'active': default: $query->where('status', 'active'); break;
        }

        $ads = $query->paginate(10);

        return view('agent.my-ads', [
            'ads' => $ads,
            'activeCount' => $activeCount,
            'pendingCount' => $pendingCount,
            'deletedCount' => $deletedCount,
            'expiredCount' => $expiredCount,
            'currentTab' => $tab,
        ]);
    }

    /**
     * Show the first step for creating a new ad (selecting the license type).
     * This method is deprecated as we now redirect directly to Step 1.
     */
    public function create()
    {
        $adPrices = AdPrice::where('is_active', true)->get();
        
        if ($adPrices->isEmpty()) {
            return redirect()->route('agent.home')->with('error', 'No ad packages are available at the moment.');
        }

        // Now, it will load the view and pass the ad packages to it.
        return view('agent.ads.create', ['adPrices' => $adPrices]);
    }

    /**
     * Show Step 1 of the ad creation form with all necessary dynamic data.
     */
    public function createStepOne(AdPrice $adPrice)
    {
        $user = Auth::user();
        $allAdPrices = AdPrice::where('is_active', true)->get();

        // --- START: Logic to calculate remaining ads ---
        $activeSubscription = Subscription::where('user_id', $user->id)
            ->where('status', 'active')
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->with('plan')
            ->first();

        // Initialize remaining ads with 0 for all possible types
        $remainingAds = [];
        foreach ($allAdPrices as $price) {
            $remainingAds[$price->type] = 0;
        }

        if ($activeSubscription && $activeSubscription->plan) {
            $plan = $activeSubscription->plan;
            $totals = [
                'regular'  => $plan->ads_regular,
                'featured' => $plan->ads_featured,
                'premium'  => $plan->ads_premium,
                'map'      => $plan->ads_map,
            ];

            // Count ads used by the user within the current subscription period
            $usedAdsCount = Ad::where('user_id', $user->id)
                ->whereBetween('ads.created_at', [$activeSubscription->start_date, $activeSubscription->end_date])
                ->join('ad_prices', 'ads.ad_price_id', '=', 'ad_prices.id')
                ->selectRaw('ad_prices.type, count(ads.id) as count')
                ->groupBy('ad_prices.type')
                ->pluck('count', 'type');

            // Calculate the difference
            foreach ($totals as $type => $total) {
                $remainingAds[$type] = max(0, $total - ($usedAdsCount[$type] ?? 0));
            }
        }
        // --- END: Logic to calculate remaining ads ---

        $cities = City::where('is_active', true)->orderBy('name')->get();
        $propertyTypes = PropertyType::where('is_active', true)->whereNull('parent_id')->orderBy('name')->get();
        $features = PropertyAttribute::where('type', 'boolean')->orderBy('name->en')->get();
        $attributes = PropertyAttribute::where('type', '!=', 'boolean')->orderBy('name->en')->get();

        return view('agent.ads.create-step-one', [
            'selectedAdPrice' => $adPrice,
            'allAdPrices' => $allAdPrices,
            'remainingAds' => $remainingAds, // <-- PASS the new variable to the view
            'cities' => $cities,
            'propertyTypes' => $propertyTypes,
            'features' => $features,
            'attributes' => $attributes,
        ]);
    }

    /**
     * Validate and store the data from Step 1 in the session.
     */
    public function storeStepOne(Request $request)
    {
        $validatedData = $request->validate([
            'ad_price_id' => 'required|exists:ad_prices,id',
            'title' => 'required|string|max:255',
            'property_type_id' => 'required|exists:property_types,id',
            'listing_purpose' => 'required|in:sale,rent',
            'total_price' => 'required|numeric|min:0',
            'area_sq_meters' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:5000',
            'district_id' => 'required|exists:districts,id',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'province' => 'required|string|max:255',
            'street_name' => 'required|string|max:255',
            'is_mortgaged' => 'required|boolean',
            'age_years' => 'nullable|integer|min:0',
            'rooms' => 'required|integer|min:0',
            'bathrooms' => 'required|integer|min:0',
            'attributes' => 'nullable|array',
        ]);

        $request->session()->put('ad_step_one_data', $validatedData);

        return redirect()->route('agent.ads.create.step2');
    }

    /**
     * Show Step 2 of the ad creation form (Media Uploads).
     */
    public function createStepTwo(Request $request)
    {
        $stepOneData = $request->session()->get('ad_step_one_data');
        if (!$stepOneData) {
            return redirect()->route('agent.ads.create');
        }
        $selectedAdPrice = AdPrice::find($stepOneData['ad_price_id']);

        return view('agent.ads.create-step-two', [
            'selectedAdPrice' => $selectedAdPrice,
        ]);
    }

    /**
     * Combines data from Step 1 & 2 and creates a single Ad record.
     */
    public function storeAd(Request $request)
    {
        $stepOneData = Session::pull('ad_step_one_data');
        if (!$stepOneData) {
            return redirect()->route('agent.ads.create')->with('error', 'Session expired. Please start over.');
        }

        $request->validate([
            'images.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
            'video' => ['nullable', 'file', 'mimes:mp4,mov,webm', 'max:51200'],
            'terms' => ['accepted'],
        ]);

        $adData = $stepOneData;
        $adData['user_id'] = Auth::id();
        $adData['status'] = 'pending';

        $adData['features'] = $adData['attributes'] ?? [];
        unset($adData['attributes']);

        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('ads/images', 'public');
                $imagePaths[] = $path;
            }
            $adData['images'] = $imagePaths;
        }

        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('ads/videos', 'public');
            $adData['video_path'] = $videoPath;
        }

        $ad = Ad::create($adData);

        Session::forget('ad_step_one_data');

        return redirect()->route('agent.my-ads')->with([
            'success' => 'تم رفع اعلان عقارك بنجاح وهو الآن قيد المراجعة.',
            'new_ad_id' => $ad->id
        ]);
    }
}