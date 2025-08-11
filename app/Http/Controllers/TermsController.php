<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TermsController extends Controller
{
    /**
     * Display the 'Terms of Use' page for the general user section.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // This will point to the new view we create in the next step
        return view('user.terms-of-use');
    }
}