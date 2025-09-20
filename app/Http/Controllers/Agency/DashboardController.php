<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Property;
use App\Models\Agent;
use App\Models\Agency;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
	public function index()
	{
		$agency = Auth::user()->agency;
		if (!$agency) {
			abort(403, 'Unauthorized');
		}

		// KPIs
		// Ads and Properties don't have a direct `agency_id` column. Use relationships instead.
		$adsCount = Ad::whereHas('agency', function ($q) use ($agency) {
			$q->where('agencies.id', $agency->id);
		})->count();

		// Properties don't have an `agent_id` column in the DB; use the property's user -> agent relationship
		$propertiesCount = Property::whereHas('user.agent', function ($q) use ($agency) {
			$q->where('agents.agency_id', $agency->id);
		})->count();

		$agentsCount = Agent::where('agency_id', $agency->id)->count();

		$newAdsLast7Days = Ad::whereHas('agency', function ($q) use ($agency) {
			$q->where('agencies.id', $agency->id);
		})->where('created_at', '>=', Carbon::now()->subDays(7))->count();

		$newPropertiesLast7Days = Property::whereHas('user.agent', function ($q) use ($agency) {
			$q->where('agents.agency_id', $agency->id);
		})->where('created_at', '>=', Carbon::now()->subDays(7))->count();

		// Summaries
		$latestAds = Ad::with('propertyType', 'district')
			->whereHas('agency', function ($q) use ($agency) {
				$q->where('agencies.id', $agency->id);
			})->latest()->take(5)->get();

		$latestProperties = Property::with('propertyType', 'district')
			->whereHas('user.agent', function ($q) use ($agency) {
				$q->where('agents.agency_id', $agency->id);
			})->latest()->take(5)->get();
		$latestAgents = Agent::where('agency_id', $agency->id)
			->latest()
			->take(5)
			->get();

		$data = [
			'adsCount' => $adsCount,
			'propertiesCount' => $propertiesCount,
			'agentsCount' => $agentsCount,
			'newAdsLast7Days' => $newAdsLast7Days,
			'newPropertiesLast7Days' => $newPropertiesLast7Days,
			'latestAds' => $latestAds,
			'latestProperties' => $latestProperties,
			'latestAgents' => $latestAgents,
			'agency' => $agency,
		];

		return view('agency.dashboard', $data);
	}
}
