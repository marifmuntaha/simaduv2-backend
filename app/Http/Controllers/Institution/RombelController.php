<?php

namespace App\Http\Controllers\Institution;

use App\Http\Controllers\Controller;
use App\Http\Requests\Institution\StoreRombelRequest;
use App\Http\Requests\Institution\UpdateRombelRequest;
use App\Http\Resources\Institution\RombelResource;
use App\Models\Institution\Rombel;
use Exception;
use Illuminate\Http\Request;

class RombelController extends Controller
{
    public function index(Request $request)
    {
        try {
            $rombels = new Rombel();
            if ($request->has('yearId')) {
                $rombels = $rombels->whereYearid($request->yearId);
            }
            if ($request->has('institutionId')) {
                $rombels = $rombels->whereInstitutionid($request->institutionId);
            }
            if ($request->has('levelId')) {
                $rombels = $rombels->whereLevelid($request->levelId);
            }
            return response()->json([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => RombelResource::collection($rombels->orderBy('alias')->get()),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function store(StoreRombelRequest $request)
    {
        try {
            return($rombel = Rombel::create($request->all()))
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Rombel berhasil ditambahkan',
                    'statusCode' => 200,
                    'result' => new RombelResource($rombel),
                ], 201) : throw new Exception('Data Rombel gagal ditambahkan', 422);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function show(Rombel $rombel)
    {
        try {
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => new RombelResource($rombel),
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function update(UpdateRombelRequest $request, Rombel $rombel)
    {
        try {
            return ($rombel->update(array_filter($request->all())))
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Rombel berhasil disimpan',
                    'statusCode' => 200,
                    'result' => new RombelResource($rombel),
                ]) : throw new Exception('Data Rombel gagal diubah', 422);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function destroy(Rombel $rombel)
    {
        try {
            return ($rombel->delete())
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Rombel berhasil dihapus',
                    'statusCode' => 200,
                    'result' => new RombelResource($rombel),
                ]) : throw new Exception('Data Rombel gagal dihapus', 422);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }
}
