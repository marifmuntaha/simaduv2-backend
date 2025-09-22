<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Setting extends Model
{
    protected $fillable = ['institutionId', 'name', 'value'];

    public function institution() : HasOne
    {
        return $this->hasOne(Institution::class, 'id', 'institutionId');
    }
}
