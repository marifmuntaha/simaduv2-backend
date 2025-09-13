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
            return response([
                'result' => StudentResource::collection($students->get())
            ]);
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(StoreStudentRequest $request)
    {
        try {
            return ($student = Student::create($request->all()))
            ? response([
                'result' => new StudentResource($student),
                'message' => 'Data berhasil ditambahkan!'
            ], 201) : throw new Exception("Data gagal ditambahkan!");

        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Student $student)
    {
        try {
            return response([
                'result' => new StudentResource($student)
            ]);
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        try {
            if ($student->update(array_filter($request->all()))) {
                return response([
                    'result' => new StudentResource($student),
                    'message' => 'Data berhasil diubah!'
                ]);
            } else {
                throw new Exception("Data gagal diubah!");
            }
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage()
            ], 442);
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
                    'result' => new StudentResource($student),
                    'message' => 'Data berhasil dihapus!'
                ]);
            } else {
                throw new Exception("Data gagal dihapus!");
            }
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage()
            ], 442);
        }
    }
}
