<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $userId
 * @property mixed $nisn
 * @property mixed $nism
 * @property mixed $name
 * @property mixed $gender
 * @property mixed $birthplace
 * @property mixed $birthdate
 * @property mixed $email
 * @property mixed $phone
 */
class StudentResource extends JsonResource
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
            'userId' => $this->userId,
            'nisn' => $this->nisn,
            'nism' => $this->nism,
            'name' => $this->name,
            'gender' => $this->gender,
            'birthplace' => $this->birthplace,
            'birthdate' => $this->birthdate,
            'email' => $this->email,
            'phone' => $this->phone,
        ];
        return $resource;
    }
}
