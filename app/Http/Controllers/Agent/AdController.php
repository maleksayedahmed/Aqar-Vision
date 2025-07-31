<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userId = Auth::id();
        $tab = $request->query('tab', 'active'); // Default to the 'active' tab

        // Base query for the logged-in user's ads
        $baseQuery = Ad::where('user_id', $userId);

        // Get counts for each tab
        $activeCount = (clone $baseQuery)->where('status', 'active')->count();
        $pendingCount = (clone $baseQuery)->where('status', 'pending')->count();
        $deletedCount = (clone $baseQuery)->onlyTrashed()->count();
        $expiredCount = (clone $baseQuery)->where('status', 'expired')->count();

        // Fetch the ads for the currently selected tab
        $query = Ad::where('user_id', $userId)->latest();

        switch ($tab) {
            case 'pending':
                $query->where('status', 'pending');
                break;
            case 'deleted':
                $query->onlyTrashed();
                break;
            case 'expired':
                $query->where('status', 'expired');
                break;
            case 'active':
            default:
                $query->where('status', 'active');
                break;
        }

        // Paginate the results to handle large numbers of ads
        $ads = $query->paginate(10);

        // Return the view with all the necessary data
        return view('agent.my-ads', [
            'ads' => $ads,
            'activeCount' => $activeCount,
            'pendingCount' => $pendingCount,
            'deletedCount' => $deletedCount,
            'expiredCount' => $expiredCount,
            'currentTab' => $tab,
        ]);
    }
}