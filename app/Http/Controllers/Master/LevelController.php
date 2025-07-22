<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\StoreLevelRequest;
use App\Http\Requests\Master\UpdateLevelRequest;
use App\Http\Resources\Master\LevelResource;
use App\Models\Master\Level;
use Exception;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function index(Request $request)
    {
        try {
            return response([
                'result' => LevelResource::collection(Level::all()),
            ]);
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(StoreLevelRequest $request)
    {
        try {
            return ($level = Level::create($request->all()))
                ? response([
                    'message' => 'Level created successfully.',
                    'result' => new LevelResource($level),
                ], 201) : throw new Exception("Failed to create Level");
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function show(Level $level)
    {
        try {
            return response([
                'result' => new LevelResource($level),
            ]);
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function update(UpdateLevelRequest $request, Level $level)
    {
        try {
            return ($level->update(array_filter($request->all())))
                ? response([
                    'message' => 'Level updated successfully.',
                    'result' => new LevelResource($level),
                ]) : throw new Exception("Failed to update Level");
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy(Level $level)
    {
        try {
            return ($level->delete())
                ? response([
                    'message' => 'Level deleted successfully.',
                ]) : throw new Exception("Failed to delete Level");
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}
