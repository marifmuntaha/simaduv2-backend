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
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => TeacherResource::collection($teachers->get()),
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function store(StoreTeacherRequest $request)
    {
        try {
            $teacher = Teacher::create($request->all());
            if ($teacher) {
                return response([
                    'status' => 'success',
                    'statusMessage' => 'Data Guru berhasil ditambahkan.',
                    'statusCode' => 201,
                    'result' => new TeacherResource($teacher),
                ], 201);
            } else {
                throw new Exception('Data Guru gagal ditambahkan.', 422);
            }
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function show(Teacher $teacher)
    {
        try {
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => new TeacherResource($teacher),
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        try {
            if ($teacher->update($request->all())) {
                return response([
                    'status' => 'success',
                    'statusMessage' => 'Data Guru berhasil disimpan.',
                    'statusCode' => 200,
                    'result' => new TeacherResource($teacher),
                ]);
            } else {
                throw new Exception("Data Guru gagal disimpan.", 422);
            }
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function destroy(Teacher $teacher)
    {
        try {
            if ($teacher->delete()) {
                return response([
                    'status' => 'success',
                    'statusMessage' => 'Data Guru berhasil dihapus.',
                    'statusCode' => 200,
                    'result' => new TeacherResource($teacher),
                ]);
            } else {
                throw new Exception("Data Guru gagal dihapus.", 422);
            }
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }
}
