<?php

namespace App\Models\Institution;

use App\Models\Master\Year;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Room extends Model
{
    protected $table = 'institution_rooms';
    protected $fillable = ['yearId', 'name', 'alias'];

    public function year(): HasOne
    {
        return $this->hasOne(Year::class, 'id', 'yearId');
    }
}
