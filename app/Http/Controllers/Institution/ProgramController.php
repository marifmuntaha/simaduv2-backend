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
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => ProgramResource::collection($programs->get()),
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function store(StoreProgramRequest $request)
    {
        try {
            return ($program = Program::create($request->all()))
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Program berhasil ditambahkan',
                    'statusCode' => 201,
                    'result' => new ProgramResource($program),
                ], 201) : throw new Exception("Data Status gagal ditambahkan", 422);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function show(Program $program)
    {
        try {
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => new ProgramResource($program),
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function update(UpdateProgramRequest $request, Program $program)
    {
        try {
            return ($program->update(array_filter($request->all())))
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Program berhasil disimpan',
                    'statusCode' => 200,
                    'result' => new ProgramResource($program),
                ]) : throw new Exception("Data Program gagal disimpan", 422);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function destroy(Program $program)
    {
        try {
            return ($program->delete())
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Program berhasil dihapus',
                    'statusCode' => 200,
                ]) : throw new Exception("Data Program gagal dihapus", 422);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }
}
