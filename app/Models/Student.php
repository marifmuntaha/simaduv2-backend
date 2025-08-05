<?php

namespace App\Models;

use App\Models\Student\Activity;
use App\Models\Student\Address;
use App\Models\Student\Parents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    protected $fillable = [
        'id',
        'userId',
        'parentId',
        'nik',
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

    public function parent(): HasOne
    {
        return $this->hasOne(Parents::class, 'id', 'parentId');
    }

    public function address(): HasOne
    {
        return $this->hasOne(Address::class, 'studentId', 'id');
    }

    public function activities(): hasMany
    {
        return $this->hasMany(Activity::class, 'studentId', 'id');
    }
}
