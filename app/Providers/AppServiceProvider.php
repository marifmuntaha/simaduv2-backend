<?php

namespace App\Providers;

use App\Models\Finance\Transaction;
use App\Models\Institution;
use App\Models\Institution\Program;
use App\Models\Institution\Rombel;
use App\Models\Master\Ladder;
use App\Models\Master\Level;
use App\Models\Master\Major;
use App\Models\Master\Year;
use App\Models\Student;
use App\Models\Student\Activity;
use App\Observers\Finance\TransactionObserve;
use App\Observers\Institution\ProgramObserver;
use App\Observers\Institution\RombelObserver;
use App\Observers\InstitutionObserver;
use App\Observers\Master\LadderObserver;
use App\Observers\Master\LevelObserver;
use App\Observers\Master\MajorObserver;
use App\Observers\Master\YearObserver;
use App\Observers\Student\ActivityObserver;
use App\Observers\StudentObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Ladder::observe(LadderObserver::class);
        Level::observe(LevelObserver::class);
        Major::observe(MajorObserver::class);
        Year::observe(YearObserver::class);
        Institution::observe(InstitutionObserver::class);
        Program::observe(ProgramObserver::class);
        Rombel::observe(RombelObserver::class);
        Student::observe(StudentObserver::class);
        Activity::observe(ActivityObserver::class);
        Transaction::observe(TransactionObserve::class);
    }
}
