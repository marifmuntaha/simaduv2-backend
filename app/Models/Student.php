<?php

namespace App\Models;

use App\Models\Institution\Program;
use App\Models\Institution\Rombel;
use App\Models\Master\Year;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    protected $fillable = [
        'userId',
        'nisn',
        'nism',
        'name',
        'gender',
        'birthplace',
        'birthdate',
        'email',
        'phone',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'userId');
    }

    public function years(): BelongsToMany
    {
        return $this->belongsToMany(Year::class, 'student_activity', 'studentId', 'yearId');
    }

    public function institutions(): BelongsToMany
    {
        return $this->belongsToMany(Institution::class, 'student_activity', 'studentId', 'institutionId');
    }

    public function rombels(): BelongsToMany
    {
        return $this->belongsToMany(Rombel::class, 'student_activity', 'studentId', 'rombelId');
    }

    public function programs(): BelongsToMany
    {
        return $this->belongsToMany(Program::class, 'student_activity', 'studentId', 'programId');
    }

}
