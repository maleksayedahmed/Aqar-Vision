<?php

namespace App\Livewire\Agent;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Notifications extends Component
{
    use WithPagination;

    // This listener will be triggered by the counter component
    protected $listeners = ['refreshNotifications' => '$refresh'];

    public function markAsRead($notificationId)
    {
        $notification = Auth::user()->notifications()->find($notificationId);
        if ($notification) {
            $notification->markAsRead();
        }
    }

    public function deleteAll()
    {
        Auth::user()->notifications()->delete();
    }

    public function render()
    {
        // Mark all visible unread notifications as read when the component renders
        Auth::user()->unreadNotifications->markAsRead();
        
        $notifications = Auth::user()->notifications()->paginate(10);
        
        return view('livewire.agent.notifications', [
            'notifications' => $notifications,
        ]);
    }
}