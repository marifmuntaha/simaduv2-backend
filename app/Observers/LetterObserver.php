<?php

namespace App\Observers;

use App\Models\Institution;
use App\Models\Letter;
use Carbon\Carbon;

class LetterObserver
{
    public function creating(Letter $letter): void
    {
        $todayMonth = Carbon::today()->format('m');
        $todayYear = Carbon::today()->format('Y');
        $institution = Institution::find($letter->institutionId);
        $lastLetter = $letter->whereYearid($letter->yearId)
            ->whereInstitutionid($letter->institutionId)
            ->orderByDesc('number')
            ->first();
        $sequence = 1;
        if ($lastLetter) {
            $lastSequence = (int) substr($lastLetter->number, 1, 3);
            $sequence = $lastSequence + 1;
        }
        $formattedSequence = str_pad($sequence, 3, '0', STR_PAD_LEFT);

        $letter->number = "{$formattedSequence}/{$letter->type}/$institution->alias/{$this->nameMonthToRoman($todayMonth)}/{$todayYear}";
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
