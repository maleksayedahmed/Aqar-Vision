<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display the packages page for the agent.
     */
    public function index()
    {
        $plans = Plan::notFree()->get();

        $basicPlan = $plans->firstWhere('name', 'Agent - Basic');
        if (!$basicPlan) {
            abort(404, 'Agent - Basic plan not found.');
        }

        $popularPlan = $plans->firstWhere('name', 'Agent - Pro');
        if (!$popularPlan) {
            abort(404, 'Agent - Pro plan not found.');
        }

        $companyPlan = $plans->firstWhere('name', 'Agency - Standard');
        if (!$companyPlan) {
            abort(404, 'Agency - Standard plan not found.');
        }

        return view('agent.packages', compact('basicPlan', 'popularPlan', 'companyPlan'));
    }
}
