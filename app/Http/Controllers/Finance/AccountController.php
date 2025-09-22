<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Http\Requests\Finance\StoreAccountRequest;
use App\Http\Requests\Finance\UpdateAccountRequest;
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
            if ($request->has('list')) {
                if ($request->list == 'table') {
                    $accounts  = $accounts->whereShown(1);
                }
            }
            if ($request->shown) {
                $accounts = $accounts->where('shown', $request->shown);
            }
            if ($request->level) {
                $accounts = $accounts->where('level', '>=', $request->level);
            }
            $accounts = $accounts->orderBy('codeApp');
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

    public function store(StoreAccountRequest $request)
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

    public function update(UpdateAccountRequest $request, Account $account)
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
