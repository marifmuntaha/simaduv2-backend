<?php

namespace App\Models;

use App\Models\Master\Ladder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;

class Institution extends Model
{
    protected $fillable = ['ladderId', 'name', 'alias', 'nsm', 'npsn', 'address', 'phone', 'email', 'website', 'logo'];
    protected function logo(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => url(Storage::url($value)),
        );
    }
    public function ladder(): HasOne
    {
        return $this->hasOne(Ladder::class, 'id', 'ladderId');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'institution_user',
            'institutionId',
            'userId'
        );
    }
}
