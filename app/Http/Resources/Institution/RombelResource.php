<?php

namespace App\Http\Resources\Institution;

use App\Http\Resources\InstitutionResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $yearId
 * @property mixed $institutionId
 * @property mixed $levelId
 * @property mixed $majorId
 * @property mixed $name
 * @property mixed $alias
 * @property mixed $teacherId
 * @property mixed $year
 * @property mixed $institution
 * @property mixed $level
 * @property mixed $major
 * @property mixed $teacher
 */
class RombelResource extends JsonResource
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
            'yearId' => $this->yearId,
            'institutionId' => $this->institutionId,
            'levelId' => $this->levelId,
            'majorId' => $this->majorId,
            'name' => $this->name,
            'alias' => $this->alias,
            'teacherId' => $this->teacherId,
            'year' => $this->year,
            'institution' => $this->institution,
            'level' => $this->level,
            'major' => $this->major,
            'teacher' => $this->teacher
        ];
        if ($request->has('type')) {
            if ($request->type == 'select') {
                $resource = [
                    'value' => $this->id,
                    'label' => $this->alias,
                ];
            }
        }
        if ($request->has('list')) {
            if ($request->list == 'table') {
                $resource = [
                    'id' => $this->id,
                    'yearId' => $this->yearId,
                    'institutionId' => $this->institutionId,
                    'levelId' => $this->levelId,
                    'majorId' => $this->majorId,
                    'name' => $this->name,
                    'alias' => $this->alias,
                    'teacherId' => $this->teacherId,
                    'yearName' => $this->year->name,
                    'institutionName' => $this->institution->ladder->alias .'. '.$this->institution->name,
                    'levelName' => $this->level->name,
                    'majorName' => $this->major->name,
                    'teacherName' => $this->teacher->name
                ];
            }
        }
        return $resource;
    }
}
