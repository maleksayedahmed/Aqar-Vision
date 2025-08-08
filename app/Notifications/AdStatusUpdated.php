<?php

namespace App\Notifications;

use App\Models\Ad;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdStatusUpdated extends Notification
{
    use Queueable;

    public $ad;

    /**
     * Create a new notification instance.
     */
    public function __construct(Ad $ad)
    {
        $this->ad = $ad;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        // We only want to store this in the database for now.
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     * This is the data that will be stored in the 'notifications' table.
     */
    public function toArray(object $notifiable): array
    {
        $statusText = $this->ad->status === 'active' ? 'تمت الموافقة على' : 'تم رفض';
        $message = "{$statusText} إعلانك: '{$this->ad->title}'";

        return [
            'ad_id' => $this->ad->id,
            'ad_title' => $this->ad->title,
            'status' => $this->ad->status,
            'message' => $message,
            'link' => route('agent.my-ads'), // Link to the ads page
        ];
    }
}