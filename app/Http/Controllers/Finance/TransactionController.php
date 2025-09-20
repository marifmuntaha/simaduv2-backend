<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Http\Requests\Finance\StoreTransactionRequest;
use App\Http\Requests\Finance\UpdateTransactionRequest;
use App\Http\Resources\Finance\TransactionResource;
use App\Models\Finance\Transaction;
use Exception;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        try {
            $transactions = new Transaction();
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => TransactionResource::collection($transactions->get())
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ]);
        }
    }

    public function store(StoreTransactionRequest $request)
    {
        try {
            $request->merge(['accountAppId' => 5]);
            return ($transaction = Transaction::create($request->all()))
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Transaksi Berhasil Ditambahkan',
                    'statusCode' => 201,
                    'result' => new TransactionResource($transaction)
                ]) : throw new Exception('Data Transaksi Gagal Ditambahkan');
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ]);
        }
    }

    public function show(Transaction $transaction)
    {
        try {
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => new TransactionResource($transaction)
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ]);
        }
    }

    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        try {
            return ($transaction->update(array_filter($request->all())))
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Transaksi Berhasil Disimpan',
                    'statusCode' => 200,
                    'result' => new TransactionResource($transaction)
                ]) : throw new Exception('Data Transaksi Gagal Disimpan');
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ]);
        }
    }

    public function destroy(Transaction $transaction)
    {
        try {
            return ($transaction->delete())
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Transaksi Berhasil Dihapus',
                    'statusCode' => 200,
                    'result' => new TransactionResource($transaction)
                ]) : throw new Exception('Data Transaksi Gagal Dihapus');
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ]);
        }
    }
}
