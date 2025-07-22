<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\StoreLadderRequest;
use App\Http\Requests\Master\UpdateLadderRequest;
use App\Http\Resources\Master\LadderResource;
use App\Models\Master\Ladder;
use Exception;
use Illuminate\Http\Request;

class LadderController extends Controller
{
    public function index(Request $request)
    {
        try {
            return response([
                'result' => LadderResource::collection(Ladder::all()),
            ]);
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(StoreLadderRequest $request)
    {
        try {
            return ($ladder = Ladder::create($request->all()))
                ? response([
                    'message' => 'Ladder created successfully.',
                    'result' => new LadderResource($ladder),
                ], 201) : throw new Exception("Failed to create Ladder");
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function show(Ladder $ladder)
    {
        try {
            return response([
                'result' => new LadderResource($ladder),
            ]);
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function update(UpdateLadderRequest $request, Ladder $ladder)
    {
        try {
            return ($ladder->update(array_filter($request->all())))
                ? response([
                    'message' => 'Ladder updated successfully.',
                    'result' => new LadderResource($ladder),
                ]) : throw new Exception("Failed to update Ladder");
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy(Ladder $ladder)
    {
        try {
            return ($ladder->delete())
                ? response([
                    'message' => 'Ladder deleted successfully.',
                ]) : throw new Exception("Failed to delete Ladder");
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}
