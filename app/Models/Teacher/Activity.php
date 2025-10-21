<?php

namespace App\Models\Teacher;

use App\Models\Institution;
use App\Models\Master\Year;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Activity extends Model
{
    protected $table = 'teacher_activities';
    protected $fillable = ['yearId', 'institutionId', 'teacherId', 'statusCode', 'status'];

    public function year(): HasOne
    {
        return $this->hasOne(Year::class, 'id', 'yearId');
    }

    public function institution(): HasOne
    {
        return $this->hasOne(Institution::class, 'id', 'institutionId');
    }

    public function teacher(): HasOne
    {
        return $this->hasOne(Teacher::class, 'id', 'teacherId');
    }
}
