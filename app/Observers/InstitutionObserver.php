<?php

namespace App\Observers;

use App\Models\Institution;
use App\Notifications\LogDBNotification;

class InstitutionObserver
{
    /**
     * Handle the Institution "created" event.
     */
    public function created(Institution $institution): void
    {
        $message = "membuat lembaga ";
        $message .= $institution->ladder->alias ." ".$institution->name;
        auth()->user()->notify(new LogDBNotification($institution, $message));
    }

    /**
     * Handle the Institution "updated" event.
     */
    public function updated(Institution $institution): void
    {
        $message = "mengubah lembaga ";
        $message .= $institution->ladder->alias ." ".$institution->name;
        auth()->user()->notify(new LogDBNotification($institution, $message));
    }

    /**
     * Handle the Institution "deleted" event.
     */
    public function deleted(Institution $institution): void
    {
        $message = "menghapus lembaga ";
        $message .= $institution->ladder->alias ." ".$institution->name;
        auth()->user()->notify(new LogDBNotification($institution, $message));
    }

    /**
     * Handle the Institution "restored" event.
     */
//    public function restored(Institution $institution): void
//    {
//        //
//    }

    /**
     * Handle the Institution "force deleted" event.
     */
//    public function forceDeleted(Institution $institution): void
//    {
//        //
//    }
}
