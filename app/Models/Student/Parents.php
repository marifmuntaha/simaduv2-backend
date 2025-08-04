<?php

namespace App\Models\Student;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Parents extends Model
{
    protected $table = 'student_parents';
    protected $fillable = [
        'userId',
        'numberKk',
        'headFamily',
        'fatherName',
        'fatherNIK',
        'fatherStatus',
        'fatherBirthplace',
        'fatherBirthdate',
        'fatherEmail',
        'fatherPhone',
        'motherName',
        'motherNIK',
        'motherStatus',
        'motherBirthplace',
        'motherBirthdate',
        'motherEmail',
        'motherPhone',
        'guardStatus',
        'guardName',
        'guardNIK',
        'guardBirthplace',
        'guardBirthdate',
        'guardEmail',
        'guardPhone',
    ];

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(
            Student::class,
            'student_parent',
            'parentId',
            'studentId'
        );
    }
}
