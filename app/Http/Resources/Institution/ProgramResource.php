<?php

namespace App\Http\Resources\Institution;

use App\Http\Resources\InstitutionResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $yearId
 * @property mixed $institutionId
 * @property mixed $name
 * @property mixed $alias
 * @property mixed $year
 * @property mixed $institution
 * @property mixed $id
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
            'id' => $this->id,
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
        if ($request->has('list')){
            if ($request->list == 'table') {
                $resource = [
                    'id' => $this->id,
                    'yearId' => $this->yearId,
                    'institutionId' => $this->institutionId,
                    'name' => $this->name,
                    'alias' => $this->alias,
                    'yearName' => $this->year->name,
                    'institutionName' => $this->institution->ladder->alias .'. '. $this->institution->name
                ];
            }
        }

        return $resource;
    }
}
