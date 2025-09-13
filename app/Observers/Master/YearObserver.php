<?php

namespace App\Observers\Master;

use App\Events\YearCreateOrUpdateEvent;
use App\Models\Master\Year;
use App\Notifications\LogDBNotification;

class YearObserver
{
    /**
     * Handle the Year "created" event.
     */
    public function created(Year $year): void
    {
        auth()->user()->notify(new LogDBNotification($year, "membuat tahun pelajaran $year->name"));
        event(new YearCreateOrUpdateEvent($year));
    }

    /**
     * Handle the Year "updated" event.
     */
    public function updated(Year $year): void
    {
        $message = "mengubah tahun pelajaran $year->name";
        $message .= $year->active == 1 ? " menjadi Aktif" : "menjadi Tidak Aktif";
        if ($year->getOriginal('active') != $year->active) {
            auth()->user()->notify(new LogDBNotification($year, $message));
        }
        event(new YearCreateOrUpdateEvent($year));
    }

    /**
     * Handle the Year "deleted" event.
     */
    public function deleted(Year $year): void
    {
        auth()->user()->notify(new LogDBNotification($year, "menghapus tahun pelajaran $year->name"));
    }

    /**
     * Handle the Year "restored" event.
     */
    public function restored(Year $year): void
    {
        //
    }

    /**
     * Handle the Year "force deleted" event.
     */
    public function forceDeleted(Year $year): void
    {
        //
    }
}
