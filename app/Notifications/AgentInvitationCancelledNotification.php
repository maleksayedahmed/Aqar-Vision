<?php

namespace App\Notifications;

use App\Models\AgentInvitation;
use Illuminate\Notifications\Notification;

class AgentInvitationCancelledNotification extends Notification
{

    public function __construct(public AgentInvitation $invitation)
    {
        //
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'invitation_id' => $this->invitation->id,
            'agency_id' => $this->invitation->agency_id,
            'agent_id' => $this->invitation->agent_id,
            'message' => 'Your invitation to join the agency has been canceled.',
            'status' => 'cancelled',
        ];
    }
}
