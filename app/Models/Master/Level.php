<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Level extends Model
{
    protected $table = 'master_levels';
    protected $fillable = ['ladderId', 'name', 'alias', 'description'];
    public $timestamps = false;

    public function ladder(): HasOne
    {
        return $this->hasOne(Ladder::class, 'id', 'ladderId');
    }
}
