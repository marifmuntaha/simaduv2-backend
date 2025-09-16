<?php

namespace App\Http\Resources\Student;

use App\Http\Resources\InstitutionResource;
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
            'numberLetter' => $this->numberLetter .'/2.1/'.$this->institution->alias.'/'.Carbon::parse($this->created_at)->format('m/Y'),
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
            'student' => $this->student,
        ];
        if ($request->has('list')){
            if ($request->list == 'table'){
                $resources = [
                    'id' => $this->id,
                    'year' => $this->year,
                    'institution' => $this->institution->ladder->alias .'. '. $this->institution->name,
                    'name' => $this->student->name,
                    'numberLetter' => $this->numberLetter .'/2.1/'.$this->institution->alias.'/'.Carbon::parse($this->created_at)->format('m/Y'),
                    'description' => $this->description,
                    'status' => $this->status,
                ];
            }
        }
        return $resources;
    }
}
