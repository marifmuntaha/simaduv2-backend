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
            $levels = new Level();
            if ($request->has('ladderId')) {
                $levels = $levels->whereLadderid($request->ladderId)->get();
            } else {
                $levels = $levels->get();
            }
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => LevelResource::collection($levels),
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statsCode' => $e->getCode(),
            ]);
        }
    }

    public function store(StoreLevelRequest $request)
    {
        try {
            return ($level = Level::create($request->all()))
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Tingkat berhasil ditambahkan',
                    'statusCode' => 201,
                    'result' => new LevelResource($level),
                ], 201) : throw new Exception("Data Tingkat gagal ditambahkan", 422);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statsCode' => $e->getCode(),
            ]);
        }
    }

    public function show(Level $level)
    {
        try {
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => new LevelResource($level),
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statsCode' => $e->getCode(),
            ]);
        }
    }

    public function update(UpdateLevelRequest $request, Level $level)
    {
        try {
            return ($level->update(array_filter($request->all())))
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Tingkat berhasil disimpan',
                    'statusCode' => 200,
                    'result' => new LevelResource($level),
                ]) : throw new Exception("Data Tingkat gagal disimpan", 422);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statsCode' => $e->getCode(),
            ]);
        }
    }

    public function destroy(Level $level)
    {
        try {
            return ($level->delete())
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Tingkat berhasil dihapus',
                    'statusCode' => 200,
                    'result' => new LevelResource($level),
                ]) : throw new Exception("Data Tingkat gagal dihapus", 422);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statsCode' => $e->getCode(),
            ]);
        }
    }
}
