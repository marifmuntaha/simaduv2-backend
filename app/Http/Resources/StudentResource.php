<?php

namespace App\Http\Resources;

use App\Http\Resources\Student\ActivityResource;
use Carbon\Carbon;
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
 * @property mixed $user
 * @property mixed $nik
 * @property mixed $parent
 * @property mixed $address
 * @method activities()
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
            'nik' => $this->nik,
            'nisn' => $this->nisn,
            'nism' => $this->nism,
            'name' => $this->name,
            'gender' => $this->gender,
            'birthplace' => $this->birthplace,
            'birthdate' => $this->birthdate,
            'email' => $this->email,
            'phone' => $this->phone,
            'user' => $this->user,
            'parent' => $this->parent,
            'address' => $this->address,
            'activity' => new ActivityResource($this->activities()->latest()->first()),
        ];
        if ($request->has('type')){
            if ($request->type == 'select'){
                $resource = [
                    'value' => $this->id,
                    'label' => $this->nisn. '-' .$this->name,
                ];
            }
            if ($request->type == 'datatable'){
                $resource = [
                    'id' => $this->id,
                    'institutionAlias' => new ActivityResource($this->activities()->first())->institution->alias,
                    'name' => $this->name,
                    'birth' => $this->birthplace . ', '. Carbon::parse($this->birthdate)->format('d F Y'),
                    'nisn' => $this->nisn,
                    'nism' => $this->nism,
                    'status' => new ActivityResource($this->activities()->latest()->first())->statusCode,
                    'rombelAlias' => new ActivityResource($this->activities()->first())->rombel->alias,
                    'boardingId' => new ActivityResource($this->activities()->first())->boardingId,
                ];
            }
        }
        return $resource;
    }
}
