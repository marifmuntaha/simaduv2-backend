<?php

namespace App\Http\Resources\Finance;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $yearId
 * @property mixed $institutionId
 * @property mixed $programId
 * @property mixed $accountId
 * @property mixed $name
 * @property mixed $alias
 * @property mixed $gender
 * @property mixed $boardingId
 * @property mixed $repeat
 * @property mixed $price
 * @property mixed $year
 * @property mixed $institution
 * @property mixed $program
 * @property mixed $account
 * @property mixed $accountAppId
 * @property mixed $accountRevId
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
            'yearId' => $this->yearId,
            'institutionId' => $this->institutionId,
            'programId' => $this->programId,
            'accountAppId' => $this->accountAppId,
            'accountRevId' => $this->accountRevId,
            'name' => $this->name,
            'alias' => $this->alias,
            'gender' => $this->gender === '0' ? 'Semua' : ($this->gender === 'L' ? 'Laki-laki' : 'Perempuan'),
            'boardingId' => $this->boardingId,
            'repeat' => $this->repeat,
            'price' => $this->price,
            'yearName' => $this->year->name,
            'institutionAlias' => $this->institution->alias,
            'programName' => $this->programId == '0' ? "Semua" : $this->program->name,
        ];

        return $resource;
    }
}
