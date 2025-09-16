<?php

namespace App\Models\Student;

use App\Models\Institution;
use App\Models\Master\Year;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Mutation extends Model
{
    protected $table = 'student_mutations';
    protected $fillable = [
        'yearId',
        'institutionId',
        'studentId',
        'type',
        'token',
        'numberLetter',
        'description',
        'schoolNPSN',
        'schoolName',
        'schoolAddress',
        'operatorName',
        'operatorPhone',
        'letterEmis',
        'status'
    ];

    public function year(): HasOne
    {
        return $this->hasOne(Year::class, 'id', 'yearId');
    }

    public function institution(): HasOne
    {
        return $this->hasOne(Institution::class, 'id', 'institutionId');
    }

    public function student(): HasOne
    {
        return $this->hasOne(Student::class, 'id', 'studentId');
    }
}
