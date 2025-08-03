<?php

namespace App\Models;

use App\Models\Student\Activity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    protected $fillable = [
        'id',
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

    public function activities(): hasMany
    {
        return $this->hasMany(Activity::class, 'studentId', 'id');
    }
}
