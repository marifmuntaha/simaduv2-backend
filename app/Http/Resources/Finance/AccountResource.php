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
 * @property mixed $parent
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
            'parent' => $this->parent,
            'codeApp' => $this->codeApp,
            'code' => $this->code,
            'name' => $this->name,
            'level' => $this->level,
            'balance' => $this->balance,
            'institutionAlias' => $this->institution->alias
        ];
        if ($request->type == 'select') {
            if( $request->with == 'level') {
                $resource = [
                    'value' => $this->id,
                    'label' => $this->codeApp ." - ". $this->name ." ($this->level)",
                    'codeApp' => $this->codeApp,
                ];
            } else {
                $resource = [
                    'value' => $this->id,
                    'label' => $this->codeApp ." - ". $this->name,
                    'codeApp' => $this->codeApp,
                ];
            }
        }
        return $resource;
    }
}
