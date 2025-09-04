<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\AdFormManagementTrait;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdController extends Controller
{
    /**
     * This controller uses a shared trait to handle all the logic for creating,
     * editing, and managing ads (except for the index page). The trait will
     * correctly render the shared views from the 'resources/views/user/ads'
     * directory.
     */
    use AdFormManagementTrait;

    /**
     * Display a listing of the agent's ads.
     * This method is unique to the agent's dashboard and is not in the shared trait.
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

        // This correctly points to the agent-specific 'my-ads' view.
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