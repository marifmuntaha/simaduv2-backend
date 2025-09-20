<?php

namespace App\Http\Resources\Finance;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $institutionId
 * @property mixed $accountAppId
 * @property mixed $accountRevId
 * @property mixed $code
 * @property mixed $number
 * @property mixed $name
 * @property mixed $amount
 * @property mixed $institution
 * @property mixed $created_at
 */
class TransactionResource extends JsonResource
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
            'code' => $this->code,
            'number' => $this->number,
            'name' => $this->name,
            'amount' => $this->amount
        ];
        if ($request->list == 'table') {
            $resource = [
                'id' => $this->id,
                'institutionId' => $this->institutionId,
                'accountAppId' => $this->accountAppId,
                'accountRevId' => $this->accountRevId,
                'code' => $this->code,
                'number' => $this->number,
                'name' => $this->name,
                'amount' => $this->amount,
                'institutionAlias' => $this->institution->alias,
                'date' => Carbon::parse($this->created_at)->format('d/m/Y'),
            ];
        }
        return $resource;
    }
}
