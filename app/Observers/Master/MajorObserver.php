<?php

namespace App\Observers\Master;

use App\Models\Master\Major;
use App\Notifications\LogDBNotification;

class MajorObserver
{
    /**
     * Handle the Major "created" event.
     */
    public function created(Major $major): void
    {
        auth()->user()->notify(new LogDBNotification($major, "membuat Jurusan $major->name"));
    }

    /**
     * Handle the Major "updated" event.
     */
    public function updated(Major $major): void
    {
        auth()->user()->notify(new LogDBNotification($major, "mengubah Jurusan $major->name"));
    }

    /**
     * Handle the Major "deleted" event.
     */
    public function deleted(Major $major): void
    {
        auth()->user()->notify(new LogDBNotification($major, "menghapus Jurusan  $major->name"));
    }

    /**
     * Handle the Major "restored" event.
     */
    public function restored(Major $major): void
    {
        //
    }

    /**
     * Handle the Major "force deleted" event.
     */
    public function forceDeleted(Major $major): void
    {
        //
    }
}
