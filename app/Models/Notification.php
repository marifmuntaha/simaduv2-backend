<?php

namespace App\Models;

use App\Events\NotificationEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Notification extends Model
{
    protected $fillable = ['message', 'status'];

    public function user(): belongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'notification_user',
            'notification_id',
            'user_id',
        )->withPivot('read');
    }

    protected $dispatchesEvents = [
        'created' => NotificationEvent::class,
    ];
}
