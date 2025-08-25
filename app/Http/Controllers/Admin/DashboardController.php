<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Agency;
use App\Models\Property;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // KPIs
        $totalRevenueThisMonth = Subscription::whereMonth('subscriptions.created_at', Carbon::now()->month)
                                            ->where('subscriptions.status', 'active')
                                            ->join('plans', 'subscriptions.plan_id', '=', 'plans.id')
                                            ->sum('plans.price_monthly');

        $newUsersLast7Days = User::where('created_at', '>=', Carbon::now()->subDays(7))->count();

        $newPropertiesLast7Days = Property::where('created_at', '>=', Carbon::now()->subDays(7))->count();

        // Summaries
        $latestProperties = Property::with('user', 'propertyType')->latest()->take(5)->get();
        $latestUsers = User::latest()->take(5)->get();

        // Old Counts (we can keep them or add new ones)
        $usersCount = User::count();
        $agenciesCount = Agency::count();
        $propertiesCount = Property::count();

        $data = [
            'totalRevenueThisMonth' => $totalRevenueThisMonth,
            'newUsersLast7Days' => $newUsersLast7Days,
            'newPropertiesLast7Days' => $newPropertiesLast7Days,
            'latestProperties' => $latestProperties,
            'latestUsers' => $latestUsers,
            'usersCount' => $usersCount,
            'agenciesCount' => $agenciesCount,
            'propertiesCount' => $propertiesCount,
        ];

        return view('admin.dashboard', $data);
    }
}
