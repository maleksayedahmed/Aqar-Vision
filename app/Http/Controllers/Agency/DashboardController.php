<?php
namespace App\Http\Controllers\Agency;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $agency = $request->user()->agency;
        $agents = $agency->agents()->withCount('ads')->get();
        $totalAds = $agents->sum('ads_count');
        
        return view('agency.dashboard', compact('agency', 'agents', 'totalAds'));
    }
}