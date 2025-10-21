<?php

namespace App\Models;

use App\Models\Teacher\Activity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class, 'teacherId', 'id');
    }
}
