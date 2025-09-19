<?php

namespace App\Http\Resources\Finance;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $institutionId
 * @property mixed $name
 * @property mixed $balance
 * @property mixed $institution
 */
class AccountResource extends JsonResource
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
            'name' => $this->name,
            'balance' => $this->balance,
            'institutionAlias' => $this->institution->alias
        ];
        if ($request->has('type')) {
            $resource = [
                'value' => $this->id,
                'label' => $this->name,
            ];
        }
        return $resource;
    }
}
