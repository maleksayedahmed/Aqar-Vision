<?php

namespace App\Livewire\User;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Notifications extends Component
{
    use WithPagination;

    public function deleteAll()
    {
        Auth::user()->notifications()->delete();
    }

    public function render()
    {
        // Mark all visible unread notifications as read when the component renders
        Auth::user()->unreadNotifications->markAsRead();
        
        $notifications = Auth::user()->notifications()->paginate(10);
        
        return view('livewire.user.notifications', [
            'notifications' => $notifications,
        ]);
    }
}