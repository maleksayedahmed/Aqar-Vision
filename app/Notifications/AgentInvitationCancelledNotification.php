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
            'message' => __('admin.notifications.agent_invitation_cancelled', ['agency_name' => $this->invitation->agency->agency_name]),
            'status' => 'cancelled',
        ];
    }
}
