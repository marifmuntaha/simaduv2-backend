<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInstitutionRequest;
use App\Http\Requests\UpdateInstitutionRequest;
use App\Http\Resources\InstitutionResource;
use App\Models\Institution;
use Exception;
use Illuminate\Support\Facades\Storage;

class InstitutionController extends Controller
{
    public function index()
    {
        try {
            return response([
                'result' => InstitutionResource::collection(Institution::all()),
            ]);
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 500);
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
                    'message' => 'Institution created successfully.',
                    'result' => new InstitutionResource($institution),
                ], 201) : throw new Exception("Failed to create Institution");
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function show(Institution $institution)
    {
        try {
            return response([
                'result' => new InstitutionResource($institution),
            ]);
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
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
                    'message' => 'Institution updated successfully.',
                    'result' => new InstitutionResource($institution),
                ]) : throw new Exception("Failed to update Institution");
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy(Institution $institution)
    {
        try {
            return ($institution->delete())
                ? response([
                    'message' => 'Institution deleted successfully.',
                ]) : throw new Exception("Failed to delete Institution");
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}
