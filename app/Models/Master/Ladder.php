<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class Ladder extends Model
{
    protected $fillable = ['name', 'alias', 'description'];
    public $timestamps = false;
}
