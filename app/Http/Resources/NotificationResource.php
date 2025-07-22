<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $status
 */
class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $icon = match ($this->status) {
            'success' => 'check-round',
            'danger' => 'cross-round',
            "warning" => 'alert-circle',
            default => 'info',
        };
        return [
            'id' => $this->id,
            'icon' => 'info',
            'iconStyle' => "bg-$this->status-dim",
            'message' => $this['message'],
            'read' => $this->user[0]->pivot->read,
        ];
    }
}
