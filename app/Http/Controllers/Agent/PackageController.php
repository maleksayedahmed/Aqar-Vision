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

        // Use filter to properly match translatable names
        $basicPlan = $plans->first(function ($plan) {
            return $plan->getTranslation('name', app()->getLocale()) === 'Agent - Basic' 
                || $plan->getTranslation('name', 'en') === 'Agent - Basic';
        });
        
        if (!$basicPlan) {
            abort(404, 'Agent - Basic plan not found.');
        }

        $popularPlan = $plans->first(function ($plan) {
            return $plan->getTranslation('name', app()->getLocale()) === 'Agent - Pro'
                || $plan->getTranslation('name', 'en') === 'Agent - Pro';
        });
        
        if (!$popularPlan) {
            abort(404, 'Agent - Pro plan not found.');
        }

        $companyPlan = $plans->first(function ($plan) {
            return $plan->getTranslation('name', app()->getLocale()) === 'Agency - Standard'
                || $plan->getTranslation('name', 'en') === 'Agency - Standard';
        });
        
        if (!$companyPlan) {
            abort(404, 'Agency - Standard plan not found.');
        }

        return view('agent.packages', compact('basicPlan', 'popularPlan', 'companyPlan'));
    }
}
