<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\StoreMajorRequest;
use App\Http\Requests\Master\UpdateMajorRequest;
use App\Http\Resources\Master\MajorResource;
use App\Models\Master\Major;
use Exception;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    public function index(Request $request)
    {
        try {
            $majors = new Major();
            if ($request->has('ladderId')) {
                $majors = $majors->whereLadderid($request->ladderId)->get();
            } else {
                $majors = $majors->get();
            }
            return response([
                'result' => MajorResource::collection($majors),
            ]);
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(StoreMajorRequest $request)
    {
        try {
            return ($major = Major::create($request->all()))
                ? response([
                    'message' => 'Major created successfully.',
                    'result' => new MajorResource($major),
                ], 201) : throw new Exception("Failed to create Major");
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function show(Major $major)
    {
        try {
            return response([
                'result' => new MajorResource($major),
            ]);
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function update(UpdateMajorRequest $request, Major $major)
    {
        try {
            return ($major->update(array_filter($request->all())))
                ? response([
                    'message' => 'Major updated successfully.',
                    'result' => new MajorResource($major),
                ]) : throw new Exception("Failed to update Major");
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy(Major $major)
    {
        try {
            return ($major->delete())
                ? response([
                    'message' => 'Major deleted successfully.',
                ]) : throw new Exception("Failed to delete Major");
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}
