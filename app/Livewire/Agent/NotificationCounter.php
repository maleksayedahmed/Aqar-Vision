<?php

namespace App\Livewire\Agent;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NotificationCounter extends Component
{
    public $unreadCount = 0;

    public function mount()
    {
        // Load the initial count when the component is first rendered
        $this->getUnreadCount();
    }
    
    public function getUnreadCount()
    {
        // Fetch the count of unread notifications for the logged-in user
        $this->unreadCount = Auth::user()->unreadNotifications()->count();
    }
    
    public function render()
    {
        return view('livewire.agent.notification-counter');
    }
}