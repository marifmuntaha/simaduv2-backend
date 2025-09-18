<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\StoreActivityRequest;
use App\Http\Requests\Student\UpdateActivityRequest;
use App\Http\Resources\Student\ActivityResource;
use App\Models\Student\Activity;
use Exception;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        try {
            $activity = Activity::whereStudentid($request->studentId)->orderBy('id', 'DESC');
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => ActivityResource::collection($activity->get()),
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function store(StoreActivityRequest $request)
    {
        try {
            return ($activity = Activity::create($request->all()))
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data aktifitas siswa berhasil ditambahkan.',
                    'statusCode' => 201,
                    'result' => new ActivityResource($activity),
                ]) : throw new Exception('Data aktifitas siswa gagal ditambahkan.', 422);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function show(Activity $activity)
    {
        try {
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => new ActivityResource($activity),
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function update(UpdateActivityRequest $request, Activity $activity)
    {
        try {
            return $activity->update(array_filter($request->all()))
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data aktifitas siswa berhasil disimpan.',
                    'statusCode' => 200,
                    'result' => new ActivityResource($activity),
                ]) : throw new Exception('Data aktifitas siswa gagal disimpan.', 422);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function destroy(Activity $activity)
    {
        try {
            return $activity->delete()
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data aktifitas siswa berhasil dihapus.',
                    'statusCode' => 200,
                    'result' => new ActivityResource($activity),
                ]) : throw new Exception('Data aktifitas siswa gagal dihapus.', 422);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }
}
