<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\City;

class HomeController extends Controller
{
    /**
     * Display the homepage.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $cities = City::where('is_active', true)->orderBy('name')->get();
        return view('home', compact('cities'));
    }
}