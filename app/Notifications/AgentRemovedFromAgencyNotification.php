<?php

namespace App\Notifications;

use App\Models\Agency;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AgentRemovedFromAgencyNotification extends Notification
{
    /**
     * Create a new notification instance.
     */
    public function __construct(public Agency $agency)
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
            'agency_id' => $this->agency->id,
            'agency_name' => $this->agency->name,
            'message' => __('admin.notifications.agent_removed_from_agency', ['agency_name' => $this->agency->name]),
            'status' => 'removed', // To help the frontend distinguish this notification
        ];
    }
}
