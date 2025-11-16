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
        $isAgent = $this->upgradeRequest->requested_role === 'agent';
        $isApproved = $this->upgradeRequest->status === 'approved';

        $messageKey = $isApproved
            ? ($isAgent ? 'admin.notifications.upgrade_request_approved_agent' : 'admin.notifications.upgrade_request_approved_agency')
            : ($isAgent ? 'admin.notifications.upgrade_request_rejected_agent' : 'admin.notifications.upgrade_request_rejected_agency');

        $status = $isApproved ? 'active' : 'inactive';

        $data = [
            'message' => __($messageKey),
            'status' => $status,
        ];

        // Add rejection reason if request was rejected and has admin notes
        if (!$isApproved && $this->upgradeRequest->admin_notes) {
            $data['rejection_reason'] = $this->upgradeRequest->admin_notes;
        }

        // If approved and the user now has an agency, provide a dashboard link
        if ($isApproved && $this->upgradeRequest->user && $this->upgradeRequest->user->agency) {
            $data['dashboard_link'] = route('agency.dashboard');
        }

        return $data;
    }
}
