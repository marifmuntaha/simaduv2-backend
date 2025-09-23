<?php

namespace App\Observers\Finance;

use App\Models\Finance\Transaction;
use Carbon\Carbon;

class TransactionObserve
{

    public function creating(Transaction $transaction): void
    {
        $today = Carbon::today()->format('Ymd');
        $lastTransaction = $transaction->whereDate('created_at', Carbon::today())
            ->orderByDesc('number')
            ->first();
        $sequence = 1;
        if ($lastTransaction) {
            $lastSequence = (int) substr($lastTransaction->number, -3);
            $sequence = $lastSequence + 1;
        }
        $formattedSequence = str_pad($sequence, 3, '0', STR_PAD_LEFT);

        $transaction->number = "{$transaction->code}-{$today}{$formattedSequence}";
    }
    /**
     * Handle the Transaction "created" event.
     */
    public function created(Transaction $transaction): void
    {
        $appBalance = $transaction->accountApp()->value('balance');
        $revBalance = $transaction->accountRev()->value('balance');
        if ($transaction->code == "KM") {
            if ($transaction->accountApp->type == 'D') {
                $newAppBalance = $appBalance + $transaction->amount;
            } else {
                $newAppBalance = $appBalance - $transaction->amount;
            }
            if ($transaction->accountRev->type == 'D') {
                $newRevBalance = $revBalance + $transaction->amount;
            } else {
                $newRevBalance = $revBalance - $transaction->amount;
            }
        } else {
            if ($transaction->accountApp->type == 'D') {
                $newAppBalance = $appBalance - $transaction->amount;
            } else {
                $newAppBalance = $appBalance - $transaction->amount;
            }
            if ($transaction->accountRev->type == 'D') {
                $newRevBalance = $revBalance + $transaction->amount;
            } else {
                $newRevBalance = $revBalance + $transaction->amount;
            }
        }
        $transaction->accountApp()->update(['balance' => $newAppBalance]);
        $transaction->accountRev()->update(['balance' => $newRevBalance]);
    }

    /**
     * Handle the Transaction "updated" event.
     */
    public function updated(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "deleted" event.
     */
    public function deleted(Transaction $transaction): void
    {
        $appBalance = $transaction->accountApp()->value('balance');
        $revBalance = $transaction->accountRev()->value('balance');
        if ($transaction->code == "KM") {
            if ($transaction->accountApp->type == 'D') {
                $newAppBalance = $appBalance - $transaction->amount;
            } else {
                $newAppBalance = $appBalance + $transaction->amount;
            }
            if ($transaction->accountRev->type == 'D') {
                $newRevBalance = $revBalance - $transaction->amount;
            } else {
                $newRevBalance = $revBalance + $transaction->amount;
            }
        } else {
            if ($transaction->accountApp->type == 'D') {
                $newAppBalance = $appBalance + $transaction->amount;
            } else {
                $newAppBalance = $appBalance + $transaction->amount;
            }
            if ($transaction->accountRev->type == 'D') {
                $newRevBalance = $revBalance - $transaction->amount;
            } else {
                $newRevBalance = $revBalance - $transaction->amount;
            }
        }
        $transaction->accountApp()->update(['balance' => $newAppBalance]);
        $transaction->accountRev()->update(['balance' => $newRevBalance]);
    }

    /**
     * Handle the Transaction "restored" event.
     */
    public function restored(Transaction $transaction): void
    {

    }

    /**
     * Handle the Transaction "force deleted" event.
     */
    public function forceDeleted(Transaction $transaction): void
    {
        //
    }
}
