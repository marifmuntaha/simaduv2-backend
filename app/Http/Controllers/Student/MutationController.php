<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\StoreMutationRequest;
use App\Http\Requests\Student\UpdateMutationRequest;
use App\Http\Resources\Student\MutationResource;
use App\Models\Student\Mutation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MutationController extends Controller
{
    public function index(Request $request)
    {
        try {
            $mutations = new Mutation();
            if ($request->has('latest')) {
                $mutations = $mutations->latest();
            }
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => MutationResource::collection($mutations->get())
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ]);
        }
    }

    public function store(StoreMutationRequest $request)
    {
        try {
            if ($request->hasFile('file')) {
                $path = Storage::disk('public')->putFileAs('document/mutation', $request->file('file'), $request->file('file')->hashName());
                $request->merge(['letterEmis' => $path]);
            }
            return ($mutation = Mutation::create($request->all()))
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data mutasi siswa berhasil disimpan',
                    'statusCode' => 201,
                    'result' => new MutationResource($mutation),
                ]) : throw new Exception('Data mutasi siswa gagal disimpan', 422);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ]);
        }
    }

    public function show(Mutation $mutation)
    {
        try {
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => new MutationResource($mutation),
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ]);
        }
    }

    public function update(UpdateMutationRequest $request, Mutation $mutation)
    {
        try {
            if ($request->hasFile('file')) {
                $oldMutation = Mutation::find($mutation->id);
                Storage::disk('public')->delete($oldMutation->letterEmis);
                $path = Storage::disk('public')->putFileAs('document/mutation', $request->file('file'), $request->file('file')->hashName());
                $request->merge(['letterEmis' => $path]);
            }
            return ($mutation->update(array_filter($request->all())))
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data mutasi siswa berhasil disimpan',
                    'statusCode' => 201,
                    'result' => new MutationResource($mutation),
                ]) : throw new Exception('Data mutasi siswa gagal disimpan', 422);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ]);
        }
    }

    public function destroy(Mutation $mutation)
    {
        try {
            return $mutation->delete()
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data mutasi siswa berhasil dihapus',
                    'statusCode' => 200,
                    'result' => new MutationResource($mutation),
                ]) : throw new Exception('Data mutasi siswa gagal dihapus', 422);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ]);
        }
    }
}
