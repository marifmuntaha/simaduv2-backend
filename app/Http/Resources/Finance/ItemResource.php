<?php

namespace App\Http\Resources\Finance;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $institutionId
 * @property mixed $name
 * @property mixed $alias
 * @property mixed $repeat
 * @property mixed $accountRevId
 * @property mixed $institution
 */
class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $resources = [
            'id' => $this->id,
            'institutionId' => $this->institutionId,
            'accountRevId' => $this->accountRevId,
            'name' => $this->name,
            'alias' => $this->alias,
            'repeat' => $this->repeat,
            'institutionAlias' => $this->institution->alias,
        ];

        if ($request->type == 'select') {
            if ($request->with == 'repeat') {
                $resources = [
                    'value' => $this->id,
                    'label' => $this->alias .' - '. $this->name,
                    'repeat' => $this->repeat,
                ];
            } else if ($request->with == 'account') {
                $resources = [
                    'value' => $this->id,
                    'label' => $this->alias .' - '. $this->name,
                    'accountRevId' => $this->accountRevId,
                ];
            } else {
                $resources = [
                    'value' => $this->id,
                    'label' => $this->alias .' - '. $this->name,
                ];
            }
        }

        return $resources;
    }
}
