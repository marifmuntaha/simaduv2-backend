<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $ladderId
 * @property mixed $name
 * @property mixed $alias
 * @property mixed $nsm
 * @property mixed $npsn
 * @property mixed $address
 * @property mixed $phone
 * @property mixed $email
 * @property mixed $website
 * @property mixed $logo
 * @property mixed $ladder
 */
class InstitutionResource extends JsonResource
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
            'ladderId' => $this->ladderId,
            'name' => $this->name,
            'alias' => $this->alias,
            'nsm' => $this->nsm,
            'npsn' => $this->npsn,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
            'website' => $this->website,
            'logo' => $this->logo,
            'ladder' => $this->ladder
        ];
        if ($request->has('ladder')) {
            if ($request->ladder == 'alias') {
                $resource['name'] = $this->ladder->alias. '. ' .$this->name;
            }
            elseif ($request->ladder == 'name') {
                $resource['name'] = $this->ladder->name. ' ' .$this->name;
            }
            else {
                $resource['name'] = $this->name;
            }
        }
        if ($request->has('type')) {
            if ($request->type == 'select') {
                $resource = [
                    'value' => $this->id,
                    'label' => $resource['name'],
                ];
            }
        }
        return $resource;
    }
}
