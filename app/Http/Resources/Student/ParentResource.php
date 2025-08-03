<?php

namespace App\Http\Resources\Student;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $numberKk
 * @property mixed $headFamily
 * @property mixed $fatherName
 * @property mixed $fatherNIK
 * @property mixed $fatherStatus
 * @property mixed $fatherBirthplace
 * @property mixed $fatherBirthdate
 * @property mixed $fatherEmail
 * @property mixed $fatherPhone
 * @property mixed $motherName
 * @property mixed $motherNIK
 * @property mixed $motherStatus
 * @property mixed $motherBirthplace
 * @property mixed $motherBirthdate
 * @property mixed $motherEmail
 * @property mixed $motherPhone
 * @property mixed $guardStatus
 * @property mixed $guardName
 * @property mixed $guardNIK
 * @property mixed $guardBirthplace
 * @property mixed $guardBirthdate
 * @property mixed $guardEmail
 * @property mixed $guardPhone
 */
class ParentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $resource = [
            'numberKk' => $this->numberKk,
            'headFamily' => $this->headFamily,
            'fatherName' => $this->fatherName,
            'fatherNIK' => $this->fatherNIK,
            'fatherStatus' => $this->fatherStatus,
            'fatherBirthplace' => $this->fatherBirthplace,
            'fatherBirthdate' => $this->fatherBirthdate,
            'fatherEmail' => $this->fatherEmail,
            'fatherPhone' => $this->fatherPhone,
            'motherName' => $this->motherName,
            'motherNIK' => $this->motherNIK,
            'motherStatus' => $this->motherStatus,
            'motherBirthplace' => $this->motherBirthplace,
            'motherBirthdate' => $this->motherBirthdate,
            'motherEmail' => $this->motherEmail,
            'motherPhone' => $this->motherPhone,
            'guardStatus' => $this->guardStatus,
            'guardName' => $this->guardName,
            'guardNIK' => $this->guardNIK,
            'guardBirthplace' => $this->guardBirthplace,
            'guardBirthdate' => $this->guardBirthdate,
            'guardEmail' => $this->guardEmail,
            'guardPhone' => $this->guardPhone,
        ];

        return $resource;
    }
}
