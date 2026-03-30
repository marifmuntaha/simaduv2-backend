<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Http\Resources\TeacherResource;
use App\Models\Teacher;
use Exception;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        try {
            $teachers = new Teacher();
            $teachers = $request->has('institutionId')
                ? $teachers->whereHas('activities', function ($query) use ($request) {
                    $query->whereInstitutionid($request->institutionId)->whereStatus(1);
                }) : $teachers;
            $teachers = $request->has('pegId') ? $teachers->wherePegid($request->pegId) : $teachers;
            return response()->success(TeacherResource::collection($teachers->get()));
        } catch (Exception $e) {
            return response()->error($e->getMessage(), 500);
        }
    }

    public function store(StoreTeacherRequest $request)
    {
        try {
            $teacher = Teacher::create($request->validated());
            return response()->success(new TeacherResource($teacher), 'Data Guru berhasil ditambahkan.', 201);
        } catch (Exception $e) {
            return response()->error($e->getMessage(), $e->getCode());
        }
    }

    public function show(Teacher $teacher)
    {
        try {
            return response()->success(new TeacherResource($teacher));
        } catch (Exception $e) {
            return response()->error($e->getMessage(), 500);
        }
    }

    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        try {
            $teacher->update($request->validated());
            return response()->success(new TeacherResource($teacher), 'Data Guru berhasil diubah.');
        } catch (Exception $e) {
            return response()->error($e->getMessage(), $e->getCode());
        }
    }

    public function destroy(Teacher $teacher)
    {
        try {
            $teacher->delete();
            return response()->success(new TeacherResource($teacher), 'Data Guru berhasil dihapus.');
        } catch (Exception $e) {
            return response()->error($e->getMessage(), $e->getCode());
        }
    }
}
