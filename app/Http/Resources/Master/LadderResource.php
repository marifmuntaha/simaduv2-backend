<?php

namespace App\Http\Resources\Master;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $name
 * @property mixed $alias
 * @property mixed $description
 */
class LadderResource extends JsonResource
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
            'name' => $this->name,
            'alias' => $this->alias,
            'description' => $this->description
        ];
        if ($request->has('type')) {
            if ($request->type == 'select'){
                $resource = [
                    'value' => $this->id,
                    'label' => $this->name,
                ];
            }
        }
        return $resource;
    }
}
