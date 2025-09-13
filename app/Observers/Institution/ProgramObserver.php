<?php

namespace App\Observers\Institution;

use App\Models\institution\Program;
use App\Notifications\LogDBNotification;

class ProgramObserver
{
    /**
     * Handle the Program "created" event.
     */
    public function created(Program $program): void
    {
        auth()->user()->notify(new LogDBNotification($program, "membuat program lembaga $program->name"));
    }

    /**
     * Handle the Program "updated" event.
     */
    public function updated(Program $program): void
    {
        auth()->user()->notify(new LogDBNotification($program, "mengubah program lembaga $program->name"));
    }

    /**
     * Handle the Program "deleted" event.
     */
    public function deleted(Program $program): void
    {
        auth()->user()->notify(new LogDBNotification($program, "menghapus program lembaga $program->name"));
    }

    /**
     * Handle the Program "restored" event.
     */
//    public function restored(Program $program): void
//    {
//        //
//    }

    /**
     * Handle the Program "force deleted" event.
     */
//    public function forceDeleted(Program $program): void
//    {
//        //
//    }
}
