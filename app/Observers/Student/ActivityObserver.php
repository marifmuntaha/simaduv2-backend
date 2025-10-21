<?php

namespace App\Observers\Student;

use App\Events\Student\ActivityCreateOrUpdateEvent;
use App\Models\Student\Activity;

class ActivityObserver
{
    /**
     * Handle the Activity "created" event.
     */
    public function created(Activity $activity): void
    {
        if ($activity->status) {
            Activity::get()->collect()->each(function ($item) use ($activity) {
                if ($item->id !== $activity->id) {
                    $item->update(['status' => 0]);
                }
            });
        }
        event(new ActivityCreateOrUpdateEvent($activity));
    }

    /**
     * Handle the Activity "updated" event.
     */
    public function updated(Activity $activity): void
    {
        if ($activity->status) {
            Activity::get()->collect()->each(function ($item) use ($activity) {
                if ($item->id !== $activity->id) {
                    $item->update(['status' => 0]);
                }
            });
        }
        event(new ActivityCreateOrUpdateEvent($activity));
    }

    /**
     * Handle the Activity "deleted" event.
     */
    public function deleted(Activity $activity): void
    {
        //
    }

    /**
     * Handle the Activity "restored" event.
     */
    public function restored(Activity $activity): void
    {
        //
    }

    /**
     * Handle the Activity "force deleted" event.
     */
    public function forceDeleted(Activity $activity): void
    {
        //
    }
}
