<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    protected $table = 'master_years';
    protected $fillable = ['name', 'description', 'active'];
}
