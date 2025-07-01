<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class NotificationComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $notificationCount = 0;

        // Ensure we only check for authenticated users
        if (Auth::check()) {
            // Check if the user is an admin or has a role that should see notifications
            if (Auth::user()->hasRole('Super Admin')) { // Or whatever your admin role is called
                $notificationCount = Auth::user()->unreadNotifications()->count();
            }
        }

        $view->with('notificationCount', $notificationCount);
    }
}
