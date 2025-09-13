<?php

namespace App\Observers\Institution;

use App\Models\institution\Rombel;
use App\Notifications\LogDBNotification;

class RombelObserver
{
    /**
     * Handle the Rombel "created" event.
     */
    public function created(Rombel $rombel): void
    {
        auth()->user()->notify(new LogDBNotification($rombel, "membuat rombel $rombel->alias"));
    }

    /**
     * Handle the Rombel "updated" event.
     */
    public function updated(Rombel $rombel): void
    {
        auth()->user()->notify(new LogDBNotification($rombel, "mengubah rombel $rombel->alias"));
    }

    /**
     * Handle the Rombel "deleted" event.
     */
    public function deleted(Rombel $rombel): void
    {
        auth()->user()->notify(new LogDBNotification($rombel, "menghapus rombel $rombel->alias"));
    }

    /**
     * Handle the Rombel "restored" event.
     */
//    public function restored(Rombel $rombel): void
//    {
//        //
//    }

    /**
     * Handle the Rombel "force deleted" event.
     */
//    public function forceDeleted(Rombel $rombel): void
//    {
//        //
//    }
}
