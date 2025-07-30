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
     * This route is triggered by a GET request and displays the contact form.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('agent.contact');
    }

    /**
     * Store a contact form submission from the agent panel.
     * This route is triggered by a POST request from the form submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Step 1: Validate the incoming request data to ensure it's safe and correct.
        // If validation fails, Laravel automatically redirects the user back with errors.
        $validatedData = $request->validate([
            'name'         => 'required|string|max:255',
            'phone'        => 'required|string|max:20',
            'email'        => 'required|email|max:255',
            'service_type' => 'required|string|max:255',
            'message'      => 'nullable|string|max:5000', // 'nullable' means this field is optional
        ]);

        // Step 2: Process the validated data.
        // For now, we will log it to the main log file for debugging purposes.
        // You can later add logic here to send an email or save it to the database.
        Log::info('New contact form submission from agent panel:', $validatedData);

        /*
        // --- Optional: Email Sending Logic ---
        // To enable this, configure your .env mail settings and create a Mailable.
        try {
            // The email address 'aqarvition@gmail.com' should ideally come from a config file.
            Mail::to('aqarvition@gmail.com')->send(new \App\Mail\AgentContactFormMail($validatedData));
        } catch (\Exception $e) {
            // If mail fails, log the specific error and inform the user.
            Log::error('Failed to send agent contact form email: ' . $e->getMessage());
            
            return back()->withInput()->with('error', 'Sorry, we could not send your message at this time. Please try again later.');
        }
        */

        // Step 3: Redirect the user back to the contact page.
        // We use `with()` to flash a success message to the session, which can be displayed in the view.
        return redirect()->route('agent.contact.create')
                         ->with('success', 'تم استلام رسالتك بنجاح، وسوف نتواصل معك في أقرب وقت ممكن!');
    }
}