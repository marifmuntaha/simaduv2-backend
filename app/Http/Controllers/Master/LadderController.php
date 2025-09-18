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
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => LadderResource::collection(Ladder::all()),
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function store(StoreLadderRequest $request)
    {
        try {
            return ($ladder = Ladder::create($request->all()))
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Jenjang berhasil ditambahkan',
                    'statusCode' => 201,
                    'result' => new LadderResource($ladder),
                ], 201) : throw new Exception("Data Jenjang gagal ditambahkan.");
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function show(Ladder $ladder)
    {
        try {
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => new LadderResource($ladder),
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function update(UpdateLadderRequest $request, Ladder $ladder)
    {
        try {
            return ($ladder->update(array_filter($request->all())))
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Jenjang berhasil disimpan',
                    'statusCode' => 200,
                    'result' => new LadderResource($ladder),
                ]) : throw new Exception("Data Jenjang gagal disimpan");
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function destroy(Ladder $ladder)
    {
        try {
            return ($ladder->delete())
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Jenjang berhasil dihapus',
                    'statusCode' => 200,
                    'result' => new LadderResource($ladder),
                ]) : throw new Exception("Data Jenjang gagal dihapus.");
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }
}
