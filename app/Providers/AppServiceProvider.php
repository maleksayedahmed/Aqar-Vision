<?php

namespace App\Providers;

use App\Http\View\Composers\NotificationComposer; // Import the class
use Illuminate\Support\Facades\View; // Import the View facade
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share notification count with all views that use the admin layout
        View::composer('admin.layouts.app', NotificationComposer::class);
    }
}
