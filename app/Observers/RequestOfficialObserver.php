<?php

namespace App\Observers;

use App\Models\RequestOfficial;
use App\Models\User;
use App\Notifications\RequestOfficialSent;

class RequestOfficialObserver
{
    /**
     * Handle the RequestOfficial "created" event.
     */
    public function created(RequestOfficial $requestOfficial): void
    {
             // Kirim notifikasi ke user yang request
        $requestOfficial->user->notify(new RequestOfficialSent($requestOfficial));

        // Kirim notifikasi ke semua admin
        $admins = User::role('admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new RequestOfficialSent($requestOfficial));
        }
    }

    /**
     * Handle the RequestOfficial "updated" event.
     */
    public function updated(RequestOfficial $requestOfficial): void
    {
        //
    }

    /**
     * Handle the RequestOfficial "deleted" event.
     */
    public function deleted(RequestOfficial $requestOfficial): void
    {
        //
    }

    /**
     * Handle the RequestOfficial "restored" event.
     */
    public function restored(RequestOfficial $requestOfficial): void
    {
        //
    }

    /**
     * Handle the RequestOfficial "force deleted" event.
     */
    public function forceDeleted(RequestOfficial $requestOfficial): void
    {
        //
    }
}
