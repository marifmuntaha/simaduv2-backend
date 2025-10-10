<?php

namespace App\Observers\Student;

use App\Models\Institution;
use App\Models\Letter;
use App\Models\Student\Mutation;
use Carbon\Carbon;
use Illuminate\Support\Str;

class MutationObserver
{
    public function creating(Mutation $mutation): void
    {
        $todayMonth = Carbon::today()->format('m');
        $todayYear = Carbon::today()->format('Y');
        $institution = Institution::find($mutation->institutionId);
        $lastLetter = Letter::whereYearid($mutation->yearId)
            ->whereInstitutionid($mutation->institutionId)
            ->orderByDesc('number')
            ->first();
        $sequence = 1;
        if ($lastLetter) {
            $lastSequence = (int) substr($lastLetter->number, 1, 3);
            $sequence = $lastSequence + 1;
        }
        $formattedSequence = str_pad($sequence, 3, '0', STR_PAD_LEFT);

        $mutation->numberLetter = "{$formattedSequence}/1.03/$institution->alias/{$this->nameMonthToRoman($todayMonth)}/{$todayYear}";
        $mutation->token = Str::uuid();
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
