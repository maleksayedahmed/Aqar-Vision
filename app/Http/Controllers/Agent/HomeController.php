<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the agent's home page.
     */
    public function index()
    {
        // Get the currently logged-in agent
        $agent = Auth::user();

        // Pass the agent's data to the view
        return view('agent.home', [
            'agent' => $agent,
        ]);
    }
}
