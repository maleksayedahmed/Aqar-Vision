<?php

namespace App\Notifications;

use App\Models\AgentInvitation;
use Illuminate\Notifications\Notification;

class AgentInvitationNotification extends Notification
{

    /**
     * Create a new notification instance.
     */
    public function __construct(public AgentInvitation $invitation)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'invitation_id' => $this->invitation->id,
            'agency_id' => $this->invitation->agency_id,
            'agent_id' => $this->invitation->agent_id,
            'message' => 'You have a new invitation to join an agency.',
        ];
    }
}
