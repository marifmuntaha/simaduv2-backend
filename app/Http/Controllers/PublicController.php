<?php

namespace App\Http\Controllers;

use App\Http\Resources\Master\YearResource;
use App\Models\Master\Year;
use Exception;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function year(Request $request)
    {
        try {
            $year = new Year();
            $year = $request->has('active') ? $year->whereActive(true) : $year;
            return response()->success(YearResource::collection($year->get()));
        } catch (Exception $e) {
            return response()->error($e->getMessage());
        }
    }
}
