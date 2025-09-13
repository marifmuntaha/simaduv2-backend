<?php

namespace App\Observers\Master;

use App\Models\Master\Level;
use App\Notifications\LogDBNotification;

class LevelObserver
{
    /**
     * Handle the Level "created" event.
     */
    public function created(Level $level): void
    {
        auth()->user()->notify(new LogDBNotification($level, "membuat Tingkat $level->name"));
    }

    /**
     * Handle the Level "updated" event.
     */
    public function updated(Level $level): void
    {
        auth()->user()->notify(new LogDBNotification($level, "mengubah Tingkat $level->name"));
    }

    /**
     * Handle the Level "deleted" event.
     */
    public function deleted(Level $level): void
    {
        auth()->user()->notify(new LogDBNotification($level, "menghapus Tingkat $level->name"));
    }

    /**
     * Handle the Level "restored" event.
     */
    public function restored(Level $level): void
    {
        //
    }

    /**
     * Handle the Level "force deleted" event.
     */
    public function forceDeleted(Level $level): void
    {
        //
    }
}
