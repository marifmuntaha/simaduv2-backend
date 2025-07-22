<?php

namespace App\Events;

use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $data;
    public int $userId;

    /**
     * Create a new event instance.
     */
    public function __construct()
    {
        $userId = auth('sanctum')->user()->id;
        $notification = [];
        Notification::whereHas('user', function ($query) use ($userId) {
            return $query->where('user_id', $userId);
        })->limit(10)->each(function ($item) use (&$notification) {
            $icon = match ($item->status) {
                'success' => 'check-round',
                'danger' => 'cross-round',
                "warning" => 'alert-circle',
                default => 'info',
            };
            $notification[] = [
                'id' => $item->id,
                'icon' => $icon,
                'iconStyle' => "bg-$item->status-dim",
                'message' => $item->message,
                'time' => Carbon::parse($item->created_at)->diffForHumans(),
                'read' => $item->user[0]->pivot->read,
            ];
        });
        $this->data = $notification;
        $this->userId = $userId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel("notifications.{$this->userId}"),
        ];
    }

    public function broadcastAs(): string
    {
        return "NotificationEvent";
    }
}
