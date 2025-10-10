<?php

namespace App\Http\Resources\Student;

use App\Http\Resources\InstitutionResource;
use App\Http\Resources\StudentResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $yearId
 * @property mixed $institutionId
 * @property mixed $studentId
 * @property mixed $type
 * @property mixed $token
 * @property mixed $numberLetter
 * @property mixed $description
 * @property mixed $schoolNPSN
 * @property mixed $schoolName
 * @property mixed $schoolAddress
 * @property mixed $operatorName
 * @property mixed $operatorPhone
 * @property mixed $letterEmis
 * @property mixed $status
 * @property mixed $institution
 * @property mixed $created_at
 * @property mixed $student
 * @property mixed $year
 */
class MutationResource extends JsonResource
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
            'studentId' => $this->studentId,
            'type' => $this->type,
            'token' => $this->token,
            'numberLetter' => $this->numberLetter,
            'description' => $this->description,
            'schoolNPSN' => $this->schoolNPSN,
            'schoolName' => $this->schoolName,
            'schoolAddress' => $this->schoolAddress,
            'operatorName' => $this->operatorName,
            'operatorPhone' => $this->operatorPhone,
            'letterEmis' => $this->letterEmis,
            'status' => $this->status,
            'year' => $this->year,
            'institution' => new InstitutionResource($this->institution),
            'student' => new StudentResource($this->student),
        ];
        if ($request->has('type')){
            if ($request->type == 'datatable'){
                $resources = [
                    'id' => $this->id,
                    'year' => $this->year,
                    'institution' => $this->institution->alias,
                    'name' => $this->student->name,
                    'numberLetter' => $this->numberLetter,
                    'description' => $this->description,
                    'status' => $this->status,
                ];
            }
        }
        return $resources;
    }
}
