<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $yearId
 * @property mixed $institutionId
 * @property mixed $number
 * @property mixed $type
 * @property mixed $data
 * @property mixed $signature
 * @property mixed $creatorId
 * @property mixed $updaterId
 * @property mixed $institution
 */
class LetterResource extends JsonResource
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
            'yearId' => $this->yearId,
            'institutionId' => $this->institutionId,
            'number' => $this->number,
            'type' => $this->type,
            'data' => $this->data,
            'signature' => $this->signature,
            'creatorId' => $this->creatorId,
            'updaterId' => $this->updaterId,
            'institution' => $this->institution
        ];
        if ($request->has('type')) {
            if ($request->type === 'datatable') {
                $resources = [
                    'id' => $this->id,
                    'yearId' => $this->yearId,
                    'institutionId' => $this->institutionId,
                    'number' => $this->number,
                    'type' => $this->type,
                    'data' => json_decode($this->data),
                    'signature' => $this->signature,
                    'creatorId' => $this->creatorId,
                    'updaterId' => $this->updaterId,
                ];
            }
        }
        return $resources;
    }
}
