<?php

namespace App\Observers;

use App\Models\Letter;
use Carbon\Carbon;

class LetterObserver
{
    public function creating(Letter $letter): void
    {
        // '001/1.01/MTs-DH/V/2025
        $todayMonth = Carbon::today()->format('m');
        $todayYear = Carbon::today()->format('Y');
        $lastLetter = $letter->whereDate('created_at', Carbon::now()->year)
            ->orderByDesc('number')
            ->first();
        $sequence = 1;
        if ($lastLetter) {
            $lastSequence = (int) substr($lastLetter->number, 3);
            $sequence = $lastSequence + 1;
        }
        $formattedSequence = str_pad($sequence, 3, '0', STR_PAD_LEFT);

        $letter->number = "{$formattedSequence}/{$letter->type}/MTS.DH/{$this->nameMonthToRoman($todayMonth)}/{$todayYear}";
        $letter->creatorId = auth()->user()->id;
        $letter->updaterId = auth()->user()->id;
    }

    private function nameMonthToRoman($nameMonth): ?string
    {
        $mappingMonth = [
            '1' => 'I',
            '2' => 'II',
            '3' => 'III',
            '4' => 'IV',
            '5' => 'V',
            '6' => 'VI',
            '7' => 'VII',
            '8' => 'VIII',
            '9' => 'IX',
            '10' => 'X',
            '11' => 'XI',
            '12' => 'XII',
        ];
        return $mappingMonth[ucfirst(strtolower($nameMonth))] ?? null;
    }
}
