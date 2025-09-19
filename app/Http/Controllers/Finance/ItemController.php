<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Http\Requests\Finance\StoreItemRequest;
use App\Http\Requests\Finance\UpdateItemRequest;
use App\Http\Resources\Finance\ItemResource;
use App\Models\Finance\Item;
use Exception;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        try {
            $items = new Item();
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => ItemResource::collection($items->get())
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ]);
        }
    }

    public function store(StoreItemRequest $request)
    {
        try {
            return ($item = Item::create($request->all()))
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Item berhasil ditambahkan.',
                    'statusCode' => 201,
                    'result' => new ItemResource($item)
                ]) : throw new Exception('Data Item gagal ditambahkan.', 422);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ]);
        }
    }

    public function show(Item $item)
    {
        try {
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => new ItemResource($item)
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ]);
        }
    }

    public function update(UpdateItemRequest $request, Item $item)
    {
        try {
            return ($item->update(array_filter($request->all())))
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Item berhasil disimpan.',
                    'statusCode' => 200,
                    'result' => new ItemResource($item)
                ]) : throw new Exception('Data Item gagal disimpan.', 422);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ]);
        }
    }

    public function destroy(Item $item)
    {
        try {
            return $item->delete()
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Item berhasil dihapus.',
                    'statusCode' => 200,
                    'result' => new ItemResource($item)
                ]) : throw new Exception('Data Item gagal dihapus.', 422);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ]);
        }
    }
}
