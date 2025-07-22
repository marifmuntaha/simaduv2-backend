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
            return response([
                'result' => YearResource::collection(Year::all()),
            ]);
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(StoreYearRequest $request)
    {
        try {
            return ($year = Year::create($request->all()))
                ? response([
                    'message' => 'Year created successfully.',
                    'result' => new YearResource($year),
                ], 201) : throw new Exception("Failed to create Year");
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function show(Year $year)
    {
        try {
            return response([
                'result' => new YearResource($year),
            ]);
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function update(UpdateYearRequest $request, Year $year)
    {
        try {
            return ($year->update(array_filter($request->all())))
                ? response([
                    'message' => 'Year updated successfully.',
                    'result' => new YearResource($year),
                ]) : throw new Exception("Failed to update Year");
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy(Year $year)
    {
        try {
            return ($year->delete())
                ? response([
                    'message' => 'Year deleted successfully.',
                ]) : throw new Exception("Failed to delete Year");
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}
