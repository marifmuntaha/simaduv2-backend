<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Major extends Model
{
    protected $table = 'master_majors';
    protected $fillable = ['ladderId', 'name', 'alias', 'description'];
    public $timestamps = false;

    public function ladder(): HasOne
    {
        return $this->hasOne(Ladder::class, 'id', 'ladderId');
    }
}
