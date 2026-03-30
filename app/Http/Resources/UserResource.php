<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

/**
 * @property mixed $id
 * @property mixed $name
 * @property mixed $email
 * @property mixed $username
 * @property mixed $phone
 * @property mixed $role
 * @method institutions()
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $resources = parent::toArray($request);

        if ($request->has('type')) {
            if ($request->type == 'profile') {
                $institution = $this->institutions()->latest()->first();
                $resources = [
                    'id' => $this->id,
                    'name' => $this->name,
                    'email' => $this->email,
                    'username' => $this->username,
                    'phone' => $this->phone,
                    'role' => $this->role,
                    'institution' => [
                        'id' => $institution?->id,
                    ],
                ];
            }
        }
        if ($request->has('list')) {
            if ($request->list === 'table') {
                $institution = $this->institutions()->get();
                $resources = [
                    'id' => $this->id,
                    'name' => $this->name,
                    'email' => $this->email,
                    'username' => $this->username,
                    'phone' => $this->phone,
                    'role' => $this->role,
                    'institution' => $institution
                ];
            }
        }
        return $resources;
    }
}
