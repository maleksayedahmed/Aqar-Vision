<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display the 'About Us' page for the agent section.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('agent.about-us');
    }
}