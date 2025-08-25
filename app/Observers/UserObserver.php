<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Agent;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $agentRoleName = 'agent';

        if ($user->hasRole($agentRoleName)) {
            Agent::create([
                'user_id' => $user->id,
                'full_name' => $user->name,
                'email' => $user->email,
                'created_by' => auth()->id() ?? $user->id,
            ]);
        }
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        $agentRoleName = 'agent';

        // SCENARIO 1: User is being made an Agent
        // Changed agents() to agent() to match the hasOne relationship in the User model.
        if ($user->hasRole($agentRoleName) && $user->agent()->doesntExist()) {
            $trashedAgent = $user->agent()->onlyTrashed()->first();
            if ($trashedAgent) {
                $trashedAgent->restore();
            } else {
                Agent::create([
                    'user_id' => $user->id,
                    'full_name' => $user->name,
                    'email' => $user->email,
                    'created_by' => auth()->id() ?? null,
                    'updated_by' => auth()->id() ?? null,
                ]);
            }
        }

        // SCENARIO 2: User is no longer an Agent
        // Changed agents() to agent()
        if (!$user->hasRole($agentRoleName) && $user->agent()->exists()) {
            $user->agent()->delete();
        }
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        // Changed agents() to agent()
        $user->agent()->delete();
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        // Changed agents() to agent()
        $user->agent()->onlyTrashed()->restore();
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}