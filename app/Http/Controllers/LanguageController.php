<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class LanguageController extends Controller
{
    /**
     * Available languages in the application
     *
     * @var array
     */
    protected $availableLocales = ['en', 'ar'];

    /**
     * Switch the application language
     *
     * @param string $lang
     * @return \Illuminate\Http\RedirectResponse
     */
    public function switchLang($lang)
    {
        try {
            // Log the requested language
            Log::info('Language switch requested to: ' . $lang);

            // Validate if the language is available
            if (!in_array($lang, $this->availableLocales)) {
                Log::warning('Invalid language requested: ' . $lang);
                return redirect()->back()->with('error', 'Language not supported.');
            }

            // Store the language in session
            Session::put('locale', $lang);
            
            // Verify the session was set
            $currentLocale = Session::get('locale');
            Log::info('Session locale set to: ' . $currentLocale);

            // Set the application locale
            App::setLocale($lang);
            
            // Verify the application locale was set
            Log::info('Application locale set to: ' . App::getLocale());

            // Clear the view cache
            \Artisan::call('view:clear');

            return redirect()->back()->with('success', 'Language changed successfully.');
        } catch (\Exception $e) {
            Log::error('Language switch error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to change language.');
        }
    }
} 