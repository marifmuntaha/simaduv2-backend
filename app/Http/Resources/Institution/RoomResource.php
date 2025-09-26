<?php

namespace App\Http\Resources\Institution;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $yearId
 * @property mixed $name
 * @property mixed $alias
 * @property mixed $year
 */
class RoomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $resource = [
            'id' => $this->id,
            'yearId' => $this->yearId,
            'name' => $this->name,
            'alias' => $this->alias,
            'year' => $this->year
        ];
        if ($request->has('type')) {
            if ($request->type == 'datatable') {
                $resource = [
                    'id' => $this->id,
                    'yearId' => $this->yearId,
                    'name' => $this->name,
                    'alias' => $this->alias,
                    'yearName' => $this->year->name
                ];
            }
        }
        return $resource;
    }
}
