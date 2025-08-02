<?php

namespace App\Http\Controllers\Institution;

use App\Http\Controllers\Controller;
use App\Http\Requests\Institution\StoreRombelRequest;
use App\Http\Requests\Institution\UpdateRombelRequest;
use App\Http\Resources\Institution\RombelResource;
use App\Models\Institution\Rombel;
use Exception;
use Illuminate\Http\Request;

class RombelController extends Controller
{
    public function index(Request $request)
    {
        try {
            $rombels = new Rombel();
            if ($request->has('yearId')) {
                $rombels = $rombels->whereYearid($request->yearId);
            }
            if ($request->has('institutionId')) {
                $rombels = $rombels->whereInstitutionid($request->institutionId);
            }
            return response()->json([
                'result' => RombelResource::collection($rombels->get()),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(StoreRombelRequest $request)
    {
        try {
            return($rombel = Rombel::create($request->all()))
                ? response([
                    'result' => $rombel,
                    'message' => 'Rombel berhasil ditambahkan',
                ], 201) : throw new Exception('Rombel gagal ditambahkan');
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function show(Rombel $rombel)
    {
        try {
            return response([
                'result' => $rombel,
            ]);
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(UpdateRombelRequest $request, Rombel $rombel)
    {
        try {
            return ($rombel->update(array_filter($request->all())))
                ? response([
                    'result' => $rombel,
                    'message' => 'Rombel berhasil diubah',
                ]) : throw new Exception('Rombel gagal diubah');
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy(Rombel $rombel)
    {
        try {
            return ($rombel->delete())
                ? response([
                    'result' => $rombel,
                    'message' => 'Rombel berhasil dihapus',
                ]) : throw new Exception('Rombel gagal dihapus');
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}
