<?php

namespace App\Http\Resources\Master;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $name
 * @property mixed $description
 * @property mixed $active
 */
class YearResource extends JsonResource
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
            'description' => $this->description,
            'active' => $this->active
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
