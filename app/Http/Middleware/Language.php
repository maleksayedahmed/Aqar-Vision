<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class Language
{
    /**
     * Available languages in the application
     *
     * @var array
     */
    protected $availableLocales = ['en', 'ar'];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            // Get locale from session or default to 'en'
            $locale = Session::get('locale', 'en');
            
            // Log the current locale for debugging
            Log::info('Current locale from session: ' . $locale);
            
            // Validate if the locale is available
            if (!in_array($locale, $this->availableLocales)) {
                $locale = 'en';
                Session::put('locale', $locale);
                Log::warning('Invalid locale detected, defaulting to: ' . $locale);
            }
            
            // Set the application locale
            App::setLocale($locale);
            
            // Verify the locale was set
            $currentLocale = App::getLocale();
            Log::info('Application locale set to: ' . $currentLocale);
            
            // Set the locale in the view
            view()->share('locale', $currentLocale);
            
            return $next($request);
        } catch (\Exception $e) {
            Log::error('Language middleware error: ' . $e->getMessage());
            return $next($request);
        }
    }
} 