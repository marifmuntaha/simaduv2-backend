<?php

namespace App\Http\Resources\Student;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $status
 * @property mixed $studentId
 * @property mixed $yearId
 * @property mixed $institutionId
 * @property mixed $rombelId
 * @property mixed $programId
 * @property mixed $boardingId
 * @property mixed $year
 * @property mixed $institution
 * @property mixed $rombel
 */
class ActivityResource extends JsonResource
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
            'status' => $this->status,
            'studentId' => $this->studentId,
            'yearId' => $this->yearId,
            'institutionId' => $this->institutionId,
            'rombelId' => $this->rombelId,
            'programId' => $this->programId,
            'boardingId' => $this->boardingId,
            'year' => $this->year,
            'institution' => $this->institution,
            'rombel' => $this->rombel,
        ];
        return $resource;
    }
}
