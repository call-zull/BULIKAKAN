<?php

namespace App\Observers;

use App\Models\User;
use App\Notifications\ProfileUpdated;
use App\Notifications\StatusUserChanged;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        //
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user)
    {
        if ($user->wasChanged('status_user')) {
            $user->notify(new StatusUserChanged($user->status_user));
        }

        if ($user->wasChanged(['username', 'email', 'profile_photo'])) {
            $user->notify(new ProfileUpdated());
        }
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
