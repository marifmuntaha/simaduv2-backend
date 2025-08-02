<?php

namespace App\Http\Controllers\Institution;

use App\Http\Controllers\Controller;
use App\Http\Requests\Institution\StoreProgramRequest;
use App\Http\Requests\Institution\UpdateProgramRequest;
use App\Http\Resources\Institution\ProgramResource;
use App\Models\Institution\Program;
use Exception;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index(Request $request)
    {
        try {
            $programs = new Program();
            if ($request->has('yearId')) {
                $programs = $programs->whereYearid($request->yearId);
            }
            if ($request->has('institutionId')) {
                $programs = $programs->whereInstitutionid($request->institutionId);
            }
            return response([
                'result' => ProgramResource::collection($programs->get()),
            ]);
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(StoreProgramRequest $request)
    {
        try {
            return ($program = Program::create($request->all()))
                ? response([
                    'message' => 'Program created successfully.',
                    'result' => new ProgramResource($program),
                ], 201) : throw new Exception("Failed to create Program");
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function show(Program $program)
    {
        try {
            return response([
                'result' => new ProgramResource($program),
            ]);
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function update(UpdateProgramRequest $request, Program $program)
    {
        try {
            return ($program->update(array_filter($request->all())))
                ? response([
                    'message' => 'Program updated successfully.',
                    'result' => new ProgramResource($program),
                ]) : throw new Exception("Failed to update Program");
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy(Program $program)
    {
        try {
            return ($program->delete())
                ? response([
                    'message' => 'Program deleted successfully.',
                ]) : throw new Exception("Failed to delete Program");
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}
