<?php

namespace App\Notifications;

use App\Models\UpgradeRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class UserUpgradeRequest extends Notification
{
    use Queueable;

    protected $upgradeRequest;

    public function __construct(UpgradeRequest $upgradeRequest)
    {
        $this->upgradeRequest = $upgradeRequest;
    }

    public function via($notifiable): array
    {
        return ['database']; // We will store it in the DB
    }

    public function toArray($notifiable): array
    {
        $roleText = $this->upgradeRequest->requested_role === 'agent' ? __('common.agent') : __('common.agency');

        return [
            'request_id' => $this->upgradeRequest->id,
            'user_name' => $this->upgradeRequest->user->name,
            'requested_role' => $this->upgradeRequest->requested_role,
            'message' => __('admin.notifications.user_upgrade_request', [
                'user_name' => $this->upgradeRequest->user->name,
                'role' => $roleText
            ]),
            'link' => route('admin.upgrade-requests.index') // Link to the management page
        ];
    }
}
