<?php

namespace App\Observers\Finance;

use App\Models\Finance\Invoice;
use Carbon\Carbon;

class InvoiceObserver
{

    public function creating(Invoice $invoice): void
    {
        $today = Carbon::today()->format('Ymd');
        $lastInvoice = $invoice->whereDate('updated_at', Carbon::today())
            ->orderByDesc('number')
            ->first();
        $sequence = 1;
        if ($lastInvoice) {
            $lastSequence = (int) substr($lastInvoice->number, -3);
            $sequence = $lastSequence + 1;
        }
        $formattedSequence = str_pad($sequence, 3, '0', STR_PAD_LEFT);

        $invoice->number = "INV-{$today}{$formattedSequence}";
    }
    /**
     * Handle the Invoice "created" event.
     */
    public function created(Invoice $invoice): void
    {
        //
    }

    /**
     * Handle the Invoice "updated" event.
     */
    public function updated(Invoice $invoice): void
    {
        //
    }

    /**
     * Handle the Invoice "deleted" event.
     */
    public function deleted(Invoice $invoice): void
    {
        //
    }

    /**
     * Handle the Invoice "restored" event.
     */
    public function restored(Invoice $invoice): void
    {
        //
    }

    /**
     * Handle the Invoice "force deleted" event.
     */
    public function forceDeleted(Invoice $invoice): void
    {
        //
    }
}
