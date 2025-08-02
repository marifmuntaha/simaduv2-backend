<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Teacher extends Model
{
    protected $fillable = [
        'userId',
        'name',
        'pegId',
        'birthplace',
        'birthdate',
        'gender',
        'frontTitle',
        'backTitle',
        'phone',
        'email',
        'address',
        'status',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'userId');
    }
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
