<?php

namespace App\Notifications;

use App\Models\AgentInvitation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AgentInvitationAcceptedNotification extends Notification
{
    /**
     * Create a new notification instance.
     */
    public function __construct(public AgentInvitation $invitation)
    {
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
            'message' => __('admin.notifications.agent_invitation_accepted', ['agent_name' => $this->invitation->agent->user->name]),
            'agent_id' => $this->invitation->agent_id,
            'invitation_id' => $this->invitation->id,
            'status' => 'accepted',
        ];
    }
}
