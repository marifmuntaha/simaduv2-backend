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
                'result' => ActivityResource::collection($activity->get()),
            ]);
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(StoreActivityRequest $request)
    {
        try {
            return ($activity = Activity::create($request->all()))
                ? response([
                    'result' => new ActivityResource($activity),
                    'message' => 'Activity has been created.'
                ]) : throw new Exception('Unable to create activity.');
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 442);
        }
    }

    public function show(Activity $activity)
    {
        try {
            return response([
                'result' => new ActivityResource($activity),
            ]);
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(UpdateActivityRequest $request, Activity $activity)
    {
        try {
            return $activity->update(array_filter($request->all()))
                ? response([
                    'result' => new ActivityResource($activity),
                    'message' => 'Activity has been updated.'
                ]) : throw new Exception('Unable to update activity.');
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 442);
        }
    }

    public function destroy(Activity $activity)
    {
        try {
            return $activity->delete()
                ? response([
                    'result' => new ActivityResource($activity),
                    'message' => 'Activity has been deleted.'
                ]) : throw new Exception('Unable to delete activity.');
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 442);
        }
    }
}
