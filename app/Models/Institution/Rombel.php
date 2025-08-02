<?php

namespace App\Models\Institution;

use App\Models\Institution;
use App\Models\Master\Level;
use App\Models\Master\Major;
use App\Models\Master\Year;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Rombel extends Model
{
    protected $fillable = ['yearId', 'institutionId', 'levelId', 'majorId', 'name', 'alias', 'teacherId'];

    public function year(): HasOne
    {
        return $this->hasOne(Year::class, 'id', 'yearId');
    }

    public function institution(): HasOne
    {
        return $this->hasOne(Institution::class, 'id', 'institutionId');
    }

    public function level(): HasOne
    {
        return $this->hasOne(Level::class, 'id', 'levelId');
    }

    public function major(): HasOne
    {
        return $this->hasOne(Major::class, 'id', 'majorId');
    }

    public function teacher(): HasOne
    {
        return $this->hasOne(Teacher::class, 'id', 'teacherId');
    }
}
