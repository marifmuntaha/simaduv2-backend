<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\StoreYearRequest;
use App\Http\Requests\Master\UpdateYearRequest;
use App\Http\Resources\Master\YearResource;
use App\Models\Master\Year;
use Exception;
use Illuminate\Http\Request;

class YearController extends Controller
{
    public function index(Request $request)
    {
        try {
            $years = new Year();
            $years = $years->orderBy('created_at', 'desc');
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => YearResource::collection($years->get()),
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function store(StoreYearRequest $request)
    {
        try {
            return ($year = Year::create($request->all()))
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Tahun Pelajaran berhasil ditambahkan',
                    'statusCode' => 201,
                    'result' => new YearResource($year),
                ], 201) : throw new Exception("Data Tahun Pelajaran Gagal Ditambahkan");
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function show(Year $year)
    {
        try {
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => new YearResource($year),
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function update(UpdateYearRequest $request, Year $year)
    {
        try {
            return ($year->update($request->all()))
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Tahun Pelajaran Berhasil Disimpan',
                    'statusCode' => 200,
                    'result' => new YearResource($year),
                ]) : throw new Exception("Data Tahun Pelajaran Gagal Disimpan");
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function destroy(Year $year)
    {
        try {
            return ($year->delete())
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Tahun Pelajaran Berhasil Dihapus',
                    'statusCode' => 200,
                    'result' => new YearResource($year),
                ]) : throw new Exception("Failed to delete Year");
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }
}
