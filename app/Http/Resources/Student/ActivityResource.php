<?php

namespace App\Http\Resources\Student;

use App\Http\Resources\Institution\ProgramResource;
use App\Http\Resources\Institution\RombelResource;
use App\Http\Resources\InstitutionResource;
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
 * @property mixed $program
 * @property mixed $created_at
 * @property mixed $levelId
 * @property mixed $statusCode
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
        return [
            'id' => $this->id,
            'status' => $this->status,
            'statusCode' => $this->statusCode,
            'studentId' => $this->studentId,
            'yearId' => $this->yearId,
            'institutionId' => $this->institutionId,
            'levelId' => $this->levelId,
            'rombelId' => $this->rombelId,
            'programId' => $this->programId,
            'boardingId' => $this->boardingId,
            'created_at' => $this->created_at,
            'year' => $this->year,
            'institution' => new InstitutionResource($this->institution),
            'rombel' => new RombelResource($this->rombel),
            'program' => new ProgramResource($this->program),
        ];
    }
}
