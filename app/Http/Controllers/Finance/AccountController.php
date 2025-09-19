<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Http\Requests\Finance\StoreAccountResource;
use App\Http\Requests\Finance\UpdateAccountResource;
use App\Http\Resources\Finance\AccountResource;
use App\Models\Finance\Account;
use Exception;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        try {
            $accounts = new Account();
            if ($request->has('institutionId')) {
                $accounts = $accounts->where('institutionId', $request->institutionId);
            }
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => AccountResource::collection($accounts->get())
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ]);
        }
    }

    public function store(StoreAccountResource $request)
    {
        try {
            return ($account = Account::create($request->all()))
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Rekening Berhasil Ditambahkan',
                    'statusCode' => 201,
                    'result' => new AccountResource($account)
                ]) : throw new Exception('Data Rekening Gagal Ditambahkan', 422);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ]);
        }
    }

    public function show(Account $account)
    {
        try {
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => new AccountResource($account)
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ]);
        }
    }

    public function update(UpdateAccountResource $request, Account $account)
    {
        try {
            return $account->update(array_filter($request->all()))
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Rekening Berhasil Diubah',
                    'statusCode' => 200,
                    'result' => new AccountResource($account)
                ]) : throw new Exception('Data Rekening Gagal Diubah', 422);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ]);
        }
    }

    public function destroy(Account $account)
    {
        try {
            return $account->delete()
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Rekening Berhasil Dihapus',
                    'statusCode' => 200,
                    'result' => new AccountResource($account)
                ]) : throw new Exception('Data Rekening Gagal Dihapus', 422);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ]);
        }
    }
}
