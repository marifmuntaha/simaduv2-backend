<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\StorePositionRequest;
use App\Http\Requests\Master\UpdatePositionRequest;
use App\Http\Resources\Master\PositionResource;
use App\Models\Master\Position;
use Illuminate\Http\Request;
use Throwable;

class PositionController extends Controller
{
    public function index(Request $request)
    {
        try {
            $positions = new Position();
            return response()->success(PositionResource::collection($positions->get()));
        } catch (Throwable $th) {
            return response()->error($th);
        }
    }

    public function store(StorePositionRequest $request)
    {
        try {
            $position = Position::create($request->validated());
            return response()->success(new PositionResource($position), 'Jabatan Struktural berhasil dibuat.');
        } catch (Throwable $th) {
            return response()->error($th);
        }
    }

    public function show(Position $position)
    {
        try {
            return response()->success(new PositionResource($position));
        } catch (Throwable $th) {
            return response()->error($th);
        }
    }

    public function update(UpdatePositionRequest $request, Position $position)
    {
        try {
            $position->update(array_filter($request->validated()));
            return response()->success(new PositionResource($position), 'Jabatan Struktural berhasil diubah.');
        } catch (Throwable $th) {
            return response()->error($th);
        }
    }

    public function destroy(Position $position)
    {
        try {
            $position->delete();
            return response()->success(new PositionResource($position), 'Jabatan Struktural berhasil dihapus.');
        } catch (Throwable $th) {
            return response()->error($th);
        }
    }
}
