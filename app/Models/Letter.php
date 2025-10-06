<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    protected $fillable = [
        'id',
        'number',
        'type',
        'data',
        'signature',
        'creatorId',
        'updaterId',
    ];
}
