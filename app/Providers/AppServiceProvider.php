<?php

namespace App\Providers;

use App\Models\Finance\Invoice;
use App\Models\Finance\Transaction;
use App\Models\Institution;
use App\Models\Institution\Program;
use App\Models\Institution\Rombel;
use App\Models\Letter;
use App\Models\Master\Ladder;
use App\Models\Master\Level;
use App\Models\Master\Major;
use App\Models\Master\Year;
use App\Models\Student;
use App\Models\Student\Activity;
use App\Models\Student\Mutation;
use App\Observers\Finance\InvoiceObserver;
use App\Observers\Finance\TransactionObserve;
use App\Observers\Institution\ProgramObserver;
use App\Observers\Institution\RombelObserver;
use App\Observers\InstitutionObserver;
use App\Observers\LetterObserver;
use App\Observers\Master\LadderObserver;
use App\Observers\Master\LevelObserver;
use App\Observers\Master\MajorObserver;
use App\Observers\Master\YearObserver;
use App\Observers\Student\ActivityObserver;
use App\Observers\Student\MutationObserver;
use App\Observers\StudentObserver;
use Illuminate\Support\Facades\Response;
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
        Response::macro('success', function ($data = null, $message = '', $code = 200) {
            return response()->json([
                'status' => 'success',
                'statusMessage' => $message,
                'result' => $data,
            ], $code);
        });

        Response::macro('error', function ($message = 'An error occurred', $code = 400) {
            return response()->json([
                'status' => 'error',
                'statusMessage' => $message,
            ], $code);
        });

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
        Invoice::observe(InvoiceObserver::class);
        Letter::observe(LetterObserver::class);
        Mutation::observe(MutationObserver::class);
    }
}
