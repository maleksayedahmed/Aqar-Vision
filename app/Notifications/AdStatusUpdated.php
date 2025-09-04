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

    public Ad $ad;
    public ?string $rejectionReason; // <-- ADD THIS PROPERTY

    /**
     * Create a new notification instance.
     * @param Ad $ad
     * @param string|null $rejectionReason
     */
    public function __construct(Ad $ad, ?string $rejectionReason = null)
    {
        $this->ad = $ad;
        $this->rejectionReason = $rejectionReason; // <-- STORE THE REASON
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        $statusText = $this->ad->status === 'active' ? 'تمت الموافقة على' : 'تم رفض';
        $message = "{$statusText} إعلانك: '{$this->ad->title}'";

        // ** THIS IS THE FIX **
        // Determine the correct link based on whether the user is an agent or not
        $link = $notifiable->agent ? route('agent.my-ads') : route('user.my-ads');

        return [
            'ad_id' => $this->ad->id,
            'ad_title' => $this->ad->title,
            'status' => $this->ad->status,
            'message' => $message,
            'rejection_reason' => $this->rejectionReason, // <-- SAVE THE REASON TO THE DATABASE
            'link' => $link,
        ];
    }
}