<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Agent;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the agent's home page.
     */
    public function index()
    {
        $user = Auth::user();
        $agent = Agent::where('user_id', $user->id)->first();

        if (!$agent) {
            return redirect('/')
                ->with('error', 'Your account does not have an associated agent profile. Please contact support.');
        }

        // --- Logic for remaining ads count ---
        $activeSubscription = Subscription::where('user_id', $user->id)
            ->where('status', 'active')
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->with('plan')
            ->first();

        $remainingAds = ['featured' => 0, 'normal' => 0, 'premium' => 0, 'map' => 0];

        if ($activeSubscription && $activeSubscription->plan) {
            $plan = $activeSubscription->plan;
            $totals = [
                'featured' => $plan->ads_featured,
                'normal' => $plan->ads_regular,
                'premium' => $plan->ads_premium,
                'map' => $plan->ads_map
            ];

            $usedAdsCount = Ad::where('user_id', $user->id)
                ->whereBetween('ads.created_at', [$activeSubscription->start_date, $activeSubscription->end_date])
                ->join('ad_prices', 'ads.ad_price_id', '=', 'ad_prices.id')
                ->selectRaw('ad_prices.type, count(ads.id) as count')
                ->groupBy('ad_prices.type')
                ->pluck('count', 'type');

            $remainingAds['featured'] = max(0, $totals['featured'] - ($usedAdsCount['featured'] ?? 0));
            $remainingAds['normal'] = max(0, $totals['normal'] - ($usedAdsCount['normal'] ?? 0));
            $remainingAds['premium'] = max(0, $totals['premium'] - ($usedAdsCount['premium'] ?? 0));
            $remainingAds['map'] = max(0, $totals['map'] - ($usedAdsCount['map'] ?? 0));
        }

        // --- START: New logic to fetch active ads for the dashboard ---
        $activeAds = Ad::where('user_id', $user->id)
            ->where('status', 'active')
            ->with(['adPrice', 'district.city']) // Eager load relationships for efficiency
            ->latest() // Order by created_at descending
            ->take(4)   // Get the latest 4 ads
            ->get();
        // --- END: New logic ---


        if ($agent->has_visited_active) {
            return view('agent.home', [
                'agent' => $agent,
                'remainingAds' => $remainingAds,
                'activeAds' => $activeAds, // <-- Pass the new active ads data to the view
            ]);
        }

        $agent->has_visited_active = true;
        $agent->save();

        return view('agent.active', [
            'agent' => $agent,
        ]);
    }
}