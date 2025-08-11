<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAdsController extends Controller
{
    /**
     * Display a listing of the user's ads with status tabs.
     */
    public function index(Request $request)
    {
        $userId = Auth::id();
        $tab = $request->query('tab', 'active'); // Default to the 'active' tab

        // Base query for the current user's ads
        $baseQuery = Ad::where('user_id', $userId);

        // Get counts for each tab efficiently
        $activeCount = (clone $baseQuery)->where('status', 'active')->count();
        $pendingCount = (clone $baseQuery)->where('status', 'pending')->count();
        $expiredCount = (clone $baseQuery)->where('status', 'expired')->count();
        // For soft-deleted ads, we need a separate query
        $deletedCount = Ad::where('user_id', $userId)->onlyTrashed()->count();

        // Start the main query for fetching the ads for the current tab
        $query = Ad::where('user_id', $userId)->with('district.city', 'propertyType')->latest();

        // Apply filter based on the selected tab
        switch ($tab) {
            case 'pending':
                $query->where('status', 'pending');
                break;
            case 'deleted':
                $query->onlyTrashed(); // Fetch only soft-deleted ads
                break;
            case 'expired':
                $query->where('status', 'expired');
                break;
            case 'active':
            default:
                $query->where('status', 'active');
                break;
        }

        // Paginate the results
        $ads = $query->paginate(10);

        // Return the view with all the necessary data
        return view('user.my-ads', [
            'ads' => $ads,
            'activeCount' => $activeCount,
            'pendingCount' => $pendingCount,
            'deletedCount' => $deletedCount,
            'expiredCount' => $expiredCount,
            'currentTab' => $tab,
        ]);
    }
}