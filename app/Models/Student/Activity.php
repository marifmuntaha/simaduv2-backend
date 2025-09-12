<?php

namespace App\Models\Student;

use App\Models\Institution;
use App\Models\Institution\Program;
use App\Models\Institution\Rombel;
use App\Models\Master\Year;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Activity extends Model
{
    protected $table = 'student_activities';
    protected $fillable = [
        'status',
        'studentId',
        'yearId',
        'institutionId',
        'levelId',
        'rombelId',
        'programId',
        'boardingId'
    ];

    public function year(): HasOne
    {
        return $this->hasOne(Year::class, 'id', 'yearId');
    }

    public function institution(): HasOne
    {
        return $this->hasOne(Institution::class, 'id', 'institutionId');
    }

    public function rombel(): HasOne
    {
        return $this->hasOne(Rombel::class, 'id', 'rombelId');
    }

    public function program(): HasOne
    {
        return $this->hasOne(Program::class, 'id', 'programId');
    }
}
