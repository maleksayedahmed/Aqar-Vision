<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the agent's home page.
     */
    public function index()
    {
        $agent = Agent::where('user_id', Auth::id())->first();

        if (!$agent) {
            // This is the confirmed fix. We redirect to the URL '/' because it has no name.
            return redirect('/')
                ->with('error', 'Your account does not have an associated agent profile. Please contact support.');
        }

        return view('agent.home', [
            'agent' => $agent,
        ]);
    }
}
