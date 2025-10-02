<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInstitutionRequest;
use App\Http\Requests\UpdateInstitutionRequest;
use App\Http\Resources\InstitutionResource;
use App\Models\Institution;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InstitutionController extends Controller
{
    public function index(Request $request)
    {
        try {
            $institutions = new Institution();
            $institutions = $request->has('institutionId')
                ? $institutions->whereId($request->institutionId)
                : $institutions;
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => InstitutionResource::collection($institutions->get()),
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function store(StoreInstitutionRequest $request)
    {
        try {
            if ($request->hasFile('image')) {
                $path = Storage::disk('public')->putFileAs('images', $request->file('image'), $request->file('image')->hashName());
                $request->merge(['logo' => $path]);
            }
            return ($institution = Institution::create($request->all()))
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Institusi berhasil ditambahkan',
                    'statusCode' => 201,
                    'result' => new InstitutionResource($institution),
                ], 201) : throw new Exception("Data Institusi gagal ditambahkan", 422);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function show(Institution $institution)
    {
        try {
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => new InstitutionResource($institution),
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function update(UpdateInstitutionRequest $request, Institution $institution)
    {
        try {
            if ($request->hasFile('image')) {
                $old = Institution::find($institution->id);
                Storage::disk('public')->delete($old->logo);
                $path = Storage::disk('public')->putFileAs('images', $request->file('image'), $request->file('image')->hashName());
                $request->merge(['logo' => $path]);
            }
            return ($institution->update(array_filter($request->all())))
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Institusi berhasil disimpan',
                    'statusCode' => 200,
                    'result' => new InstitutionResource($institution),
                ]) : throw new Exception("Data Institusi gagal disimpan", 422);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function destroy(Institution $institution)
    {
        try {
            if ($institution->delete()) {
                Storage::disk('public')->delete($institution->logo);
                return response([
                    'status' => 'success',
                    'statusMessage' => 'Data Institusi berhasil dihapus',
                    'statusCode' => 200,
                ]);
            } else {
                throw new Exception("Data Institusi gagal dihapus", 422);
            }
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }
}
