<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Model;

class Mutation extends Model
{
    protected $table = 'student_mutations';
    protected $fillable = [
        'yearId',
        'institutionId',
        'studentId',
        'type',
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
}
