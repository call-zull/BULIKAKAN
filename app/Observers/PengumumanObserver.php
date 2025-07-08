<?php

namespace App\Observers;

use App\Models\Pengumuman;
use App\Notifications\PengumumanStatusChanged;

class PengumumanObserver
{
    /**
     * Handle the Pengumuman "created" event.
     */
    public function created(Pengumuman $pengumuman): void
    {
        //
    }

    /**
     * Handle the Pengumuman "updated" event.
     */
    public function updated(Pengumuman $pengumuman): void
    {
        if ($pengumuman->isDirty('status')) {
            $newStatus = $pengumuman->status;
            $user = $pengumuman->user;

            if ($user) {
                $user->notify(new PengumumanStatusChanged($pengumuman, $newStatus));
            }
        }
    }

    /**
     * Handle the Pengumuman "deleted" event.
     */
    public function deleted(Pengumuman $pengumuman): void
    {
        //
    }

    /**
     * Handle the Pengumuman "restored" event.
     */
    public function restored(Pengumuman $pengumuman): void
    {
        //
    }

    /**
     * Handle the Pengumuman "force deleted" event.
     */
    public function forceDeleted(Pengumuman $pengumuman): void
    {
        //
    }
}
