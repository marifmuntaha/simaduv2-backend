<?php

namespace App\Http\Resources\Master;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $ladderId
 * @property mixed $name
 * @property mixed $alias
 * @property mixed $description
 * @property mixed ladder
 */
class LevelResource extends JsonResource
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
            'ladderId' => $this->ladderId,
            'name' => $this->name,
            'alias' => $this->alias,
            'description' => $this->description,
            'ladder' => $this->ladder
        ];
        if ($request->has('type')) {
            if ($request->type == 'select') {
                $resource = [
                    'value' => $this->id,
                    'label' => $this->name,
                ];
            }
        }
        return $resource;
    }
}
