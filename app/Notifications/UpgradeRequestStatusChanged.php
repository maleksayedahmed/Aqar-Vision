<?php

namespace App\Notifications;

use App\Models\UpgradeRequest;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpgradeRequestStatusChanged extends Notification
{

    public $upgradeRequest;

    /**
     * Create a new notification instance.
     */
    public function __construct(UpgradeRequest $upgradeRequest)
    {
        $this->upgradeRequest = $upgradeRequest;
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
        $roleText = $this->upgradeRequest->requested_role === 'agent' ? 'وسيط عقاري' : 'شركة عقارية';
        
        $status = $this->upgradeRequest->status === 'approved' ? 'active' : 'inactive';
        
        $message = $this->upgradeRequest->status === 'approved'
            ? "تمت الموافقة على طلب ترقية حسابك إلى {$roleText}."
            : "تم رفض طلب ترقية حسابك إلى {$roleText}.";

        $data = [
            'message' => $message,
            'status' => $status,
        ];

        // Add rejection reason if request was rejected and has admin notes
        if ($this->upgradeRequest->status === 'rejected' && $this->upgradeRequest->admin_notes) {
            $data['rejection_reason'] = $this->upgradeRequest->admin_notes;
        }

        // If approved and the user now has an agency, provide a dashboard link
        if ($this->upgradeRequest->status === 'approved' && $this->upgradeRequest->user && $this->upgradeRequest->user->agency) {
            $data['dashboard_link'] = route('agency.dashboard');
        }

        return $data;
    }
}
