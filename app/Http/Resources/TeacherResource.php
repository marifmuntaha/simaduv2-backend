<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $name
 * @property mixed $pageID
 * @property mixed $birthplace
 * @property mixed $birthdate
 * @property mixed $gender
 * @property mixed $frontTitle
 * @property mixed $backTitle
 * @property mixed $phone
 * @property mixed $email
 * @property mixed $address
 * @property mixed $institution
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
        $resource = [
            'id' => $this->id,
            'name' => $this->name,
            'pageID' => $this->pageID,
            'birthplace' => $this->birthplace,
            'birthdate' => $this->birthdate,
            'gender' => $this->gender,
            'frontTitle' => $this->frontTitle,
            'backTitle' => $this->backTitle,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            'fullName' => $this->frontTitle. ' ' .$this->name. ' '. $this->backTitle,
            'institution' => $this->institution
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
