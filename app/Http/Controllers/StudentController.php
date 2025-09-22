<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        try {
            $students = new Student();
            if ($request->has('yearId')) {
                $students = $students->whereHas('activities', function ($query) use ($request) {
                    $query->where('yearId', $request->yearId)->latest();
                });
            }
            if ($request->has('institutionId')) {
                $students = $students->whereHas('activities', function ($query) use ($request) {
                    $query->where('institutionId', $request->institutionId)->latest();
                });
            }
            if ($request->has('rombelId')) {
                $students = $students->whereHas('activities', function ($query) use ($request) {
                    $query->where('rombelId', $request->rombelId)->where('status', '1');
                });
            }
            if ($request->has('boardingId')) {
                $students = $students->whereHas('activities', function ($query) use ($request) {
                    $query->where('boardingId', $request->boardingId)->where('status', '1');
                });
            }
            if ($request->has('levelId')) {
                $students = $students->whereHas('activities', function ($query) use ($request) {
                    $query->where('levelId', $request->levelId)->where('status', '1');
                });
            }
            if ($request->has('programId')) {
                $students = $students->whereHas('activities', function ($query) use ($request) {
                    $query->where('programId', $request->programId)->where('status', '1');
                });
            }
            $students = $request->has('gender') ? $students->whereGender($request->gender) : $students;
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => StudentResource::collection($students->get())
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function store(StoreStudentRequest $request)
    {
        try {
            return ($student = Student::create($request->all()))
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Siswa berhasil ditambahkan!',
                    'statusCode' => 201,
                    'result' => new StudentResource($student),
                ], 201) : throw new Exception("Data Siswa gagal ditambahkan!", 422);

        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ], 422);
        }
    }

    public function show(Student $student)
    {
        try {
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => new StudentResource($student)
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        try {
            if ($student->update(array_filter($request->all()))) {
                return response([
                    'status' => 'success',
                    'statusMessage' => 'Data Siswa berhasil disimpan!',
                    'statusCode' => 200,
                    'result' => new StudentResource($student),
                ]);
            } else {
                throw new Exception("Data Siswa gagal diubah!", 422);
            }
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ], 422);
        }
    }

    public function destroy(Student $student)
    {
        try {
            if ($student->delete()) {
                $student->activities()->delete();
                $student->address()->delete();
                $student->user()->delete();
                return response([
                    'status' => 'success',
                    'statusMessage' => 'Data Siswa berhasil dihapus!',
                    'statusCode' => 200,
                    'result' => new StudentResource($student),
                ]);
            } else {
                throw new Exception("Data Siswa gagal dihapus!", 422);
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
