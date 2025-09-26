<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Ladder extends Model
{
    use Notifiable;

    protected $table = 'master_ladders';
    protected $fillable = ['name', 'alias', 'description'];
    public $timestamps = false;
}
