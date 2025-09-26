<?php

namespace App\Http\Controllers\Institution;

use App\Http\Controllers\Controller;
use App\Http\Requests\Institution\StoreRoomRequest;
use App\Http\Requests\Institution\UpdateRoomRequest;
use App\Http\Resources\Institution\RoomResource;
use App\Models\Institution\Room;
use Exception;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        try {
            $rooms = new Room();
            $rooms = $request->has('yearId') ? $rooms->whereYearid($request->yearId) : $rooms;
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => RoomResource::collection($rooms->get())
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ]);
        }
    }

    public function store(StoreRoomRequest $request)
    {
        try {
            return ($room = Room::create($request->all()))
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Kamar Santri berhasil ditambahkan',
                    'statusCode' => 201,
                    'result' => new RoomResource($room)
                ]) : throw new Exception('Data Kamar Santri gagal ditambahkan');
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ]);
        }
    }

    public function show(Room $room)
    {
        try {
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => new RoomResource($room)
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ]);
        }
    }

    public function update(UpdateRoomRequest $request, Room $room)
    {
        try {
            return ($room->update($request->all()))
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Kamar Santri berhasil disimpan',
                    'statusCode' => 201,
                    'result' => new RoomResource($room)
                ]) : throw new Exception('Data Kamar Santri gagal disimpan');
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ]);
        }
    }

    public function destroy(Room $room)
    {
        try {
            return ($room->delete())
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Kamar Santri berhasil dihapus',
                    'statusCode' => 201,
                    'result' => new RoomResource($room)
                ]) : throw new Exception('Data Kamar Santri gagal dihapus');
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ]);
        }
    }
}
