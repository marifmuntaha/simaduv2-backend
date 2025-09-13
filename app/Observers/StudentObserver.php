<?php

namespace App\Observers;

use App\Models\Student;
use App\Notifications\LogDBNotification;

class StudentObserver
{
    /**
     * Handle the Student "created" event.
     */
    public function created(Student $student): void
    {
        auth()->user()->notify(new LogDBNotification($student, "menambahkan siswa baru $student->name"));
    }

    /**
     * Handle the Student "updated" event.
     */
    public function updated(Student $student): void
    {
        auth()->user()->notify(new LogDBNotification($student, "mengubah siswa $student->name"));
    }

    /**
     * Handle the Student "deleted" event.
     */
    public function deleted(Student $student): void
    {
        auth()->user()->notify(new LogDBNotification($student, "menghapus siswa $student->name"));
    }

    /**
     * Handle the Student "restored" event.
     */
//    public function restored(Student $student): void
//    {
//        //
//    }

    /**
     * Handle the Student "force deleted" event.
     */
//    public function forceDeleted(Student $student): void
//    {
//        //
//    }
}
