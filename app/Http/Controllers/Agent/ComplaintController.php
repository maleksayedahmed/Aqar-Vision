<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class ComplaintController extends Controller
{
    /**
     * Display the complaint and suggestion form.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('agent.complaints');
    }

    /**
     * Store a new complaint or suggestion submitted by an agent.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // 1. Validate the incoming data from the form.
        $validatedData = $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'email', 'max:255'],
            'type'    => ['required', Rule::in(['complaint', 'suggestion', 'feedback'])],
            'details' => ['required', 'string', 'min:10', 'max:5000'],
        ]);

        // 2. Process the data. For now, we log it to the application's log file.
        // You can later replace this with logic to send an email or save to a database table.
        Log::info('New complaint/suggestion submitted from agent panel:', $validatedData);

        // 3. Redirect the user back to the form page with a success message.
        return redirect()->route('agent.complaints.create')
                         ->with('success', 'تم استلام رسالتك بنجاح. شكراً لمشاركتك رأيك!');
    }
}