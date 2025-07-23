<?php

namespace App\Http\Resources\Institution;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $yearId
 * @property mixed $institutionId
 * @property mixed $name
 * @property mixed $alias
 * @property mixed $year
 * @property mixed $institution
 */
class ProgramResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $resource = [
            'yearId' => $this->yearId,
            'institutionId' => $this->institutionId,
            'name' => $this->name,
            'alias' => $this->alias,
            'year' => $this->year,
            'institution' => $this->institution
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
