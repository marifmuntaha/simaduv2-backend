<?php

namespace App\Models\Master;

use App\Traits\TrackUser;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Concerns\LogsActivity;

class Position extends Model
{
    use LogsActivity, TrackUser;

    protected $table = 'master_positions';
    protected $fillable = ['name', 'description', 'alias', 'createdBy', 'updatedBy'];
}
