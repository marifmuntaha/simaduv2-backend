<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Http\Resources\TeacherResource;
use App\Models\Teacher;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        try {
            $teachers = new Teacher();
            if ($request->has('institutionId')) {
                $teachers = $teachers->whereHas('institution', function ($item) use ($request) {
                    $item->where('institutionId', $request->institutionId);
                });
            }
            if ($request->has('status')) {
                $teachers = $teachers->where('status', $request->status);
            }
            return response([
                'result' => TeacherResource::collection($teachers->get()),
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
            $teacher = Teacher::create($request->all());
            if ($teacher) {
                $teacher->institution()->attach($request->institution);
                return response([
                    'message' => 'Teacher created successfully.',
                    'result' => new TeacherResource($teacher),
                ], 201);
            }
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
            if ($teacher->update(array_filter($request->all()))) {
                $teacher->institution()->sync($request->institution);
                return response([
                    'message' => 'Teacher updated successfully.',
                    'result' => new TeacherResource($teacher),
                ]);
            } else {
                throw new Exception("Failed to update Teacher");
            }
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy(Teacher $teacher)
    {
        try {
            if ($teacher->delete()) {
                $teacher->institution()->detach();
                $teacher->user->delete();
                return response([
                    'message' => 'Teacher deleted successfully.',
                ]);
            }
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}
