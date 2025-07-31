<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Show the contact form page.
     * This method handles the GET request to display the contact form view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('agent.contact');
    }

       /**
     * Store a new contact form submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // 1. Validate the incoming form data.
        $validatedData = $request->validate([
            'name'         => 'required|string|max:255',
            'phone'        => 'required|string|max:20',
            'email'        => 'required|email|max:255',
            'service_type' => 'required|string|max:255',
            'message'      => 'nullable|string|max:5000',
        ]);

        // 2. Process the data (log, email, etc.)
        Log::info('New contact form submission received:', $validatedData);

        // 3. Redirect back to the contact page using the NEW route name.
        return redirect()->route('agent.contact') // <-- THIS LINE WAS UPDATED
                         ->with('success', 'تم استلام رسالتك بنجاح وسوف نتواصل معك قريبا!');
    }
}