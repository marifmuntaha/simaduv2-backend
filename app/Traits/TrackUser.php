<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * @mixin Model
 */

trait TrackUser
{
    public static function bootTrackUser(): void
    {
        static::creating(function ($model) {
            if (Auth::check()) {
                $model->createdBy = Auth::id();
                $model->updatedBy = Auth::id();
            }
        });

        static::updating(function ($model) {
            if (Auth::check()) {
                $model->updatedBy = Auth::id();
            }
        });

    }
}
