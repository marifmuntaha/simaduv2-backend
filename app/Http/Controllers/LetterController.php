<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLetterRequest;
use App\Http\Requests\UpdateLetterRequest;
use App\Http\Resources\LetterResource;
use App\Models\Letter;
use Exception;
use Illuminate\Http\Request;

class LetterController extends Controller
{
    public function index(Request $request)
    {
        try {
            $letters = new Letter();
            $letters = $request->has('yearId') ? $letters->whereYearid($request->yearId) : $letters;
            $letters = $request->has('institutionId') ? $letters->whereInstitutionid($request->institutionId) : $letters;
            $letters = $letters->orderBy('created_at', 'desc');
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => LetterResource::collection($letters->get()),
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ], $e->getCode());
        }
    }

    public function store(StoreLetterRequest $request)
    {
        try {
            return ($letter = Letter::create($request->only(['yearId', 'institutionId', 'type', 'signature', 'data'])))
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Surat Berhasil Dibuat',
                    'statusCode' => 201,
                    'result' => new LetterResource($letter)
                ]) : throw new Exception('Data Surat Gagal Dibuat');
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ], 442);
        }
    }

    public function show(Letter $letter)
    {
        try {
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => new LetterResource($letter)
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ], $e->getCode());
        }
    }

    public function update(UpdateLetterRequest $request, Letter $letter)
    {
        try {
            return ($letter->update(array_filter($request->all())))
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Surat Berhasil Diubah',
                    'statusCode' => 200,
                    'result' => new LetterResource($letter)
                ]) : throw new Exception('Data Surat Gagal Diubah');
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ], $e->getCode());
        }
    }

    public function destroy(Letter $letter)
    {
        try {
            return ($letter->delete())
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Surat Berhasil Dihapus',
                    'statusCode' => 200,
                    'result' => new LetterResource($letter)
                ]) : throw new Exception('Data Surat Gagal Dihapus');
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ], $e->getCode());
        }
    }

    public function print(Request $request)
    {

    }
}
