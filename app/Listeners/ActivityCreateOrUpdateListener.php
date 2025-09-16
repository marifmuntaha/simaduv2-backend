<?php

namespace App\Listeners;

use App\Events\ActivityCreateOrUpdateEvent;
use App\Models\Student\Activity;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ActivityCreateOrUpdateListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ActivityCreateOrUpdateEvent $event): void
    {
        if ($event->activity->status === '1'){
            $activities = Activity::whereStudentid($event->activity->studentId)->get()->collect();
            $activities->map(function ($activity) use ($event) {
                if ($activity->id != $event->activity->id){
                    $activity->status = '4';
                    $activity->save();
                }
            });
        }
    }
}
