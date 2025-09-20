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
 * @property mixed $accountAppId
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
        $resource = [
            'id' => $this->id,
            'institutionId' => $this->institutionId,
            'accountAppId' => $this->accountAppId,
            'accountRevId' => $this->accountRevId,
            'name' => $this->name,
            'alias' => $this->alias,
            'repeat' => $this->repeat,
            'institutionAlias' => $this->institution->alias,
        ];

        return $resource;
    }
}
