<?php

namespace App\Observers\Master;

use App\Models\Master\Ladder;
use App\Notifications\LogDBNotification;

class LadderObserver
{
    /**
     * Handle the Ladder "created" event.
     */
    public function created(Ladder $ladder): void
    {
        auth()->user()->notify(new LogDBNotification($ladder, "membuat Jenjang $ladder->name"));
    }

    /**
     * Handle the Ladder "updated" event.
     */
    public function updated(Ladder $ladder): void
    {
        auth()->user()->notify(new LogDBNotification($ladder, "mengubah Jenjang $ladder->name"));
    }

    /**
     * Handle the Ladder "deleted" event.
     */
    public function deleted(Ladder $ladder): void
    {
        auth()->user()->notify(new LogDBNotification($ladder, "menghapus Jenjang $ladder->name"));
    }

    /**
     * Handle the Ladder "restored" event.
     */
//    public function restored(Ladder $ladder): void
//    {
//        //
//    }

    /**
     * Handle the Ladder "force deleted" event.
     */
//    public function forceDeleted(Ladder $ladder): void
//    {
//        //
//    }
}
