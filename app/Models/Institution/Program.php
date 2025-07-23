<?php

namespace App\Models\Institution;

use App\Models\Institution;
use App\Models\Master\Year;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Program extends Model
{
    protected $fillable = ['yearId', 'institutionId', 'name', 'alias'];

    public function year(): HasOne
    {
        return $this->hasOne(Year::class, 'id', 'yearId');
    }

    public function institution(): HasOne
    {
        return $this->hasOne(Institution::class, 'id', 'institutionId');
    }
}
