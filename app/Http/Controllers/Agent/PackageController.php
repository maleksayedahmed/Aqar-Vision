<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display the packages page for the agent.
     */
    public function index()
    {
        return view('agent.packages');
    }
}