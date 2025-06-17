<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Agency;
use App\Models\AgencyType;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'usersCount' => User::count(),
            'agenciesCount' => Agency::count(),
            'agencyTypesCount' => AgencyType::count(),
            'recentActivities' => collect() // You can implement activity logging later
        ];

        return view('admin.dashboard', $data);
    }
} 