<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\StoreActivityRequest;
use App\Http\Requests\Teacher\UpdateActivityRequest;
use App\Http\Resources\Teacher\ActivityResource;
use App\Models\Teacher\Activity;
use Exception;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        try {
            $activities = new Activity();
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => 500,
            ], 500);
        }
    }

    public function store(StoreActivityRequest $request)
    {
        try {
            return ($activity = Activity::create($request->all()))
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Aktivitas Berhasil Dibuat',
                    'statusCode' => 201,
                    'result' => new ActivityResource($activity)
                ]) : throw new Exception('Data Aktivitas Gagal Dibuat');
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => 422,
            ], 422);
        }
    }

    public function show(Activity $activity)
    {
        try {
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'activity' => new ActivityResource($activity)
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => 500,
            ], 500);
        }
    }

    public function update(UpdateActivityRequest $request, Activity $activity)
    {
        try {
            return ($activity->update($request->all()))
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Aktivitas Berhasil Diubah',
                    'statusCode' => 200,
                    'activity' => new ActivityResource($activity)
                ]) : throw new Exception('Data Aktivitas Gagal Diubah');
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => 422,
            ], 422);
        }
    }

    public function destroy(Activity $activity)
    {
        try {
            $activity->delete()
                ? response([
                'status' => 'success',
                'statusMessage' => 'Data Aktivitas Berhasil Dihapus',
                'statusCode' => 200,
            ]) : throw new Exception('Data Aktivitas Gagal Dihapus');
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => 422,
            ], 422);
        }
    }
}
