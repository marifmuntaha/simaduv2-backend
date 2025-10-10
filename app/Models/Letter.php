<?php

namespace App\Models;

use App\Models\Master\Year;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Letter extends Model
{
    protected $fillable = [
        'id',
        'yearId',
        'institutionId',
        'number',
        'type',
        'data',
        'signature',
        'creatorId',
        'updaterId',
        'token'
    ];

    public function year(): HasOne
    {
        return $this->hasOne(Year::class, 'id', 'yearId');
    }

    public function institution(): HasOne
    {
        return $this->hasOne(Institution::class, 'id', 'institutionId');
    }
}
