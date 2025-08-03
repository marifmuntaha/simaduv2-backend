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
            return response([
                'result' => ParentResource::collection($parent->get()),
            ]);
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(StoreParentRequest $request)
    {
        try {
            if($parent = Parents::create($request->all())) {
                $parent->students()->attach([$request->studentId]);
                return response([
                    'result' => new ParentResource($parent),
                    'message' => 'Data Orangtua berhasil ditambahkan!'
                ]);
            } else {
                throw new Exception('Data Orangtua gagal ditambahkan!');
            }
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function show(Parents $parent)
    {
        try {
            return response([
                'result' => new ParentResource($parent),
            ]);
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(UpdateParentRequest $request, Parents $parent)
    {
        try {
            if ($parent->update($request->all())) {
                $parent->students()->sync([$request->studentId]);
                return response([
                    'result' => new ParentResource($parent),
                    'message' => 'Data Orangtua berhasil diubah!'
                ]);
            } else {
                throw new Exception('Data Orangtua gagal diubah!');
            }
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy(Parents $parent)
    {
        try {
            return $parent->delete()
                ? response([
                    'message' => 'Data Orangtua berhasil dihapus!',
                    'result' => new ParentResource($parent),
                ]) : throw new Exception('Data Orangtua gagal dihapus!');
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}
