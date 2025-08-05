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
                'result' => AddressResource::collection($address->get())
            ]);
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(StoreAddressRequest $request)
    {
        try {
            return ($address = Address::create($request->all()))
                ? response([
                    'result' => new AddressResource($address),
                    'message' => 'Address added successfully!'
                ]) : throw new Exception('Address not added!');
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage()
            ], 422);
        }
    }

    public function show(Address $address)
    {
        try {
            return response([
                'result' => new AddressResource($address)
            ]);
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(UpdateAddressRequest $request, Address $address)
    {
        try {
            return $address->update(array_filter($request->all()))
                ? response([
                    'result' => new AddressResource($address),
                    'message' => 'Address updated successfully!'
                ]) : throw new Exception('Address not updated!');
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage()
            ], 422);
        }
    }

    public function destroy(Address $address)
    {
        try {
            return $address->delete()
                ? response([
                    'result' => new AddressResource($address),
                    'message' => 'Address deleted successfully!'
                ]) : throw new Exception('Address not deleted!');
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage()
            ], 422);
        }
    }
}
