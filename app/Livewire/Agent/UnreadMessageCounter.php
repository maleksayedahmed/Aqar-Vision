<?php

namespace App\Livewire\Agent;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Message;

class UnreadMessageCounter extends Component
{
    public $unreadCount = 0;

    public function mount()
    {
        $this->getUnreadMessageCount();
    }

    public function getUnreadMessageCount()
    {
        $userId = Auth::id();

        if ($userId) {
            $this->unreadCount = Message::where('is_read', false)
                ->where('user_id', '!=', $userId)
                ->whereHas('conversation', function ($query) use ($userId) {
                    $query->where(function ($q) use ($userId) {
                        $q->where('sender_id', $userId)
                          ->orWhere('receiver_id', $userId);
                    });
                })
                ->count();
        }
    }

    public function render()
    {
        return view('livewire.agent.unread-message-counter');
    }
}
