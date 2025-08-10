<?php

namespace App\Providers;

use App\Http\View\Composers\NotificationComposer;
use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
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
        User::observe(UserObserver::class);
        
        // --- THIS IS THE CORRECTED SVG VALIDATION LOGIC ---
        // This creates a new custom validation rule named 'image_or_svg'
        Validator::extend('image_or_svg', function ($attribute, $value, $parameters, $validator) {
            // This rule is only for uploaded files
            if (!is_a($value, \Illuminate\Http\UploadedFile::class)) {
                return false;
            }

            // Get the file's reported MIME type
            $mime = $value->getMimeType();

            // Check if it's a standard image type OR an SVG.
            // Some servers report SVGs as 'text/plain' or other types,
            // so we also check the file extension as a fallback.
            $extension = strtolower($value->getClientOriginalExtension());
            
            return in_array($mime, ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml']) || $extension === 'svg';
        });
    }
}