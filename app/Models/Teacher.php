<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Teacher extends Model
{
    protected $fillable = [
        'name',
        'pageID',
        'birthplace',
        'birthdate',
        'gender',
        'frontTitle',
        'backTitle',
        'phone',
        'email',
        'address'
    ];

    public function institution(): BelongsToMany
    {
        return $this->belongsToMany(
            Institution::class,
            'teacher_institution',
            'teacherId',
            'institutionId'
        );
    }
}
