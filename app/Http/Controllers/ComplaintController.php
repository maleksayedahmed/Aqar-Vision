<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class ComplaintController extends Controller
{
    /**
     * Display the complaint and suggestion form for a regular user.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // This will point to the new user view we create next
        return view('user.complaints');
    }

    /**
     * Store a new complaint or suggestion submitted by a user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // 1. Validate the incoming data. The rules are the same as the agent's.
        $validatedData = $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'email', 'max:255'],
            'type'    => ['required', Rule::in(['complaint', 'suggestion', 'feedback'])],
            'details' => ['required', 'string', 'min:10', 'max:5000'],
        ]);

        // 2. Process the data. We'll log it, noting it came from a regular user.
        Log::info('New complaint/suggestion submitted from USER panel:', $validatedData);

        // 3. Redirect back to the user's complaint form page with a success message.
        return redirect()->route('user.complaints.create')
                         ->with('success', 'تم استلام رسالتك بنجاح. شكراً لمشاركتك رأيك!');
    }
}