<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\StoreAddressRequest;
use App\Http\Requests\Student\UpdateAddressRequest;
use App\Http\Resources\Student\AddressResource;
use App\Models\Student\Address;
use Exception;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index(Request $request)
    {
        try {
            $address = new Address();
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => AddressResource::collection($address->get())
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ]);
        }
    }

    public function store(StoreAddressRequest $request)
    {
        try {
            return ($address = Address::create($request->all()))
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data alamat siswa berhasil ditambahkan.',
                    'statusCode' => 201,
                    'result' => new AddressResource($address),
                ]) : throw new Exception('Data alamat siswa gagal ditambahkan.', 422);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ]);
        }
    }

    public function show(Address $address)
    {
        try {
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => new AddressResource($address)
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function update(UpdateAddressRequest $request, Address $address)
    {
        try {
            return $address->update(array_filter($request->all()))
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data alamat siswa berhasil disimpan.',
                    'statusCode' => 200,
                    'result' => new AddressResource($address),
                ]) : throw new Exception('Data alamat siswa gagal disimpan.', 422);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function destroy(Address $address)
    {
        try {
            return $address->delete()
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data alamat siswa berhasil dihapus.',
                    'statusCode' => 200,
                    'result' => new AddressResource($address),
                ]) : throw new Exception('Data alamat siswa gagal dihapus.', 422);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }
}
