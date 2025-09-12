<?php

namespace App\Models\Master;

use App\Events\YearCreateOrUpdateEvent;
use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    protected $fillable = ['name', 'description', 'active'];

    protected static function booted(): void
    {
        static::created(function (Year $year) {
            event(new YearCreateOrUpdateEvent($year));
        });

        static::updated(function (Year $year) {
            event(new YearCreateOrUpdateEvent($year));
        });
    }
}
