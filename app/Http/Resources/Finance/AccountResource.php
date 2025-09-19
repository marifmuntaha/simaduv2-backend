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
 * @property mixed $code
 * @property mixed $codeApp
 * @property mixed $level
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
            'codeApp' => $this->codeApp,
            'code' => $this->code,
            'name' => $this->name,
            'level' => $this->level,
            'balance' => $this->balance,
            'institutionAlias' => $this->institution->alias
        ];
        if ($request->has('type')) {
            if ($request->type == 'select') {
                $resource = [
                    'value' => $this->codeApp,
                    'label' => $this->codeApp ." - ". $this->name ." ($this->level)",
                ];
            }
        }
        return $resource;
    }
}
