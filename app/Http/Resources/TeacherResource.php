<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $name
 * @property mixed $pegId
 * @property mixed $birthplace
 * @property mixed $birthdate
 * @property mixed $gender
 * @property mixed $frontTitle
 * @property mixed $backTitle
 * @property mixed $phone
 * @property mixed $email
 * @property mixed $address
 * @property mixed $institution
 * @property mixed $status
 * @property mixed $userId
 * @method institution(\Closure $param)
 */
class TeacherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $fullName = '';

        if ($this->frontTitle != '' || $this->frontTitle != null) {
            $fullName .= $this->frontTitle. '. ';
        }
        $fullName .= $this->name;
        if ($this->backTitle != '' || $this->backTitle != null) {
            $fullName .= ', ' .$this->backTitle;
        }

        $resource = [
            'id' => $this->id,
            'userId' => $this->userId,
            'pegId' => $this->pegId,
            'name' => $this->name,
            'birthplace' => $this->birthplace,
            'birthdate' => $this->birthdate,
            'gender' => $this->gender,
            'frontTitle' => $this->frontTitle,
            'backTitle' => $this->backTitle,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            'institution' => $this->institution,
            'status' => $this->status,
            'fullName' => $fullName,
        ];

        if ($request->has('type')) {
            if ($request->type == 'select') {
                $resource = [
                    'value' => $this->id,
                    'label' => $resource['fullName'],
                ];
            }
        }
        return $resource;
    }
}
