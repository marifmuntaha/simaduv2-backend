<?php

namespace App\Models;

use App\Models\Master\Ladder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Institution extends Model
{
    protected $fillable = ['ladderId', 'name', 'alias', 'nsm', 'npsn', 'address', 'phone', 'email', 'website', 'logo'];

    public function ladder(): HasOne
    {
        return $this->hasOne(Ladder::class, 'id', 'ladderId');
    }
}
