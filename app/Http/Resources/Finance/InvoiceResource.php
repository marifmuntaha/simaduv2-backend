<?php

namespace App\Http\Resources\Finance;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
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
            'institutionId' => $this->institutionId,
            'itemId' => $this->itemId,
            'studentId' => $this->studentId,
            'number' => $this->number,
            'name' => $this->name,
            'amount' => $this->amount,
            'status' => $this->status,
            'institution' => $this->institution,
            'item' => $this->item,
            'student' => $this->student
        ];
        if ($request->list === 'table') {
            $resource = [
                'id' => $this->id,
                'institutionId' => $this->institutionId,
                'itemId' => $this->itemId,
                'studentId' => $this->studentId,
                'number' => $this->number,
                'name' => $this->name,
                'amount' => $this->amount,
                'status' => $this->status,
                'institutionAlias' => $this->institution->alias,
                'date' => Carbon::parse($this->created_at)->format('d/m/Y'),
                'studentName' => $this->student->name
            ];
        }
        return $resource;
    }
}
