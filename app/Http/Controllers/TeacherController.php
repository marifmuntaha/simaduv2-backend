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
            return response([
                'result' => TeacherResource::collection(Teacher::all()),
            ]);
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(StoreTeacherRequest $request)
    {
        try {
            return ($teacher = Teacher::create($request->all()))
                ? response([
                    'message' => 'Teacher created successfully.',
                    'result' => new TeacherResource($teacher),
                ], 201) : throw new Exception("Failed to create Teacher");
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function show(Teacher $teacher)
    {
        try {
            return response([
                'result' => new TeacherResource($teacher),
            ]);
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        try {
            return ($teacher->update(array_filter($request->all())))
                ? response([
                    'message' => 'Teacher updated successfully.',
                    'result' => new TeacherResource($teacher),
                ]) : throw new Exception("Failed to update Teacher");
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy(Teacher $teacher)
    {
        try {
            return ($teacher->delete())
                ? response([
                    'message' => 'Teacher deleted successfully.',
                ]) : throw new Exception("Failed to delete Teacher");
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}
