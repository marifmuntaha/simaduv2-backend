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
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => MajorResource::collection($majors),
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function store(StoreMajorRequest $request)
    {
        try {
            return ($major = Major::create($request->all()))
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Jurusan berhasil ditambahkan.',
                    'statusCode' => 201,
                    'result' => new MajorResource($major),
                ], 201) : throw new Exception("Data Jurusan gagal ditambahkan.", 422);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function show(Major $major)
    {
        try {
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => new MajorResource($major),
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function update(UpdateMajorRequest $request, Major $major)
    {
        try {
            return ($major->update(array_filter($request->all())))
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Jurusan berhasil disimpan.',
                    'statusCode' => 201,
                    'result' => new MajorResource($major),
                ]) : throw new Exception("Data Jurusan gagal disimpan.", 422);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function destroy(Major $major)
    {
        try {
            return ($major->delete())
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Jurusan berhasil dihapus.',
                    'statusCode' => 200,
                ]) : throw new Exception("Data Jurusan gagal dihapus.", 422);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }
}
