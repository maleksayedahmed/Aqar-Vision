<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Agent; // Import the Agent model

class UserObserver
{
    /**
     * Handle the User "created" event.
     * This runs when your UserController@store method creates a new user.
     */
    public function created(User $user): void
    {
        $agentRoleName = 'agent'; // Or whatever you name your role

        // If the user was created with the 'Agent' role, create an agent record.
        if ($user->hasRole($agentRoleName)) {
            Agent::create([
                'user_id' => $user->id,
                'full_name' => $user->name,
                'email' => $user->email,
                'created_by' => auth()->id() ?? $user->id, // If created by system/seeder, use its own id
            ]);
        }
    }

    /**
     * Handle the User "updated" event.
     * This runs when your UserController@update method syncs roles.
     */
    public function updated(User $user): void
    {
         dd('USER OBSERVER "UPDATED" METHOD WAS CALLED FOR USER:', $user->name);
        $agentRoleName = 'agent'; // Or whatever you name your role

        // SCENARIO 1: User is being made an Agent
        // Check if the user now has the 'Agent' role AND doesn't have an agent record yet.
        if ($user->hasRole($agentRoleName) && $user->agents()->doesntExist()) {
            // Restore a soft-deleted record if it exists, otherwise create a new one.
            $trashedAgent = $user->agents()->onlyTrashed()->first();
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
        // Check if the user NO LONGER has the role but STILL has an active agent record.
        if (!$user->hasRole($agentRoleName) && $user->agents()->exists()) {
            // Soft delete all associated agent records
            $user->agents()->delete();
        }
    }

    /**
     * Handle the User "deleted" event.
     * This runs when your UserController@destroy method deletes a user.
     */
    public function deleted(User $user): void
    {
        // When the user is deleted, we should also soft-delete their agent profile(s).
        // This is good practice for data integrity. The Agent model uses SoftDeletes.
        $user->agents()->delete();
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        // Optional: If you ever restore a user, you might want to restore their agent record too.
        $user->agents()->onlyTrashed()->restore();
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
