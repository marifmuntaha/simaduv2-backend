<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\StoreParentRequest;
use App\Http\Requests\Student\UpdateParentRequest;
use App\Http\Resources\Student\ParentResource;
use App\Models\Student\Parents;
use Exception;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    public function index(Request $request)
    {
        try {
            $parent = new Parents();
            if ($request->has('numberKk')) {
                $parent = $parent->where('numberKk', $request->numberKk);
            }
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => ParentResource::collection($parent->get()),
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function store(StoreParentRequest $request)
    {
        try {
            return ($parent = Parents::create($request->all()))
            ? response([
                'status' => 'success',
                'statusMessage' => 'Data orangtua berhasil ditambahkan',
                'statusCode' => 201,
                'result' => new ParentResource($parent),
            ]) : throw new Exception('Data Orangtua gagal ditambahkan!', 422);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function show(Parents $parent)
    {
        try {
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => new ParentResource($parent),
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function update(UpdateParentRequest $request, Parents $parent)
    {
        try {
            if ($parent->update($request->all())) {
                return response([
                    'status' => 'success',
                    'statusMessage' => 'Data orangtua berhasil disimpan',
                    'statusCode' => 200,
                    'result' => new ParentResource($parent),
                ]);
            } else {
                throw new Exception('Data Orangtua gagal disimpan!', 422);
            }
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function destroy(Parents $parent)
    {
        try {
            return $parent->delete()
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Orangtua berhasil dihapus!',
                    'statusCode' => 200,
                    'result' => new ParentResource($parent),
                ]) : throw new Exception('Data Orangtua gagal dihapus!', 422);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }
}
