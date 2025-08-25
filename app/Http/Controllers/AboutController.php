<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display the 'About Us' page for the general user section.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // This will point to the new view we create in the next step
        return view('user.about-us');
    }
}