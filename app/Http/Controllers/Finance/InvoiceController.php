<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Http\Requests\Finance\StoreInvoiceRequest;
use App\Http\Requests\Finance\UpdateInvoiceRequest;
use App\Http\Resources\Finance\InvoiceResource;
use App\Models\Finance\Invoice;
use Exception;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        try {
            $invoices = new Invoice();
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => InvoiceResource::collection($invoices->get())
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ]);
        }
    }

    public function store(StoreInvoiceRequest $request)
    {
        try {
            return ($invoice = Invoice::create($request->all()))
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Tagihan Berhasil Ditambahkan',
                    'statusCode' => 201,
                    'result' => new InvoiceResource($invoice)
                ]) : throw new Exception('Data Tagihan Gagal Ditambahkan');
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ]);
        }
    }

    public function show(Invoice $invoice)
    {
        try {
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => new InvoiceResource($invoice)
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ]);
        }
    }

    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        try {
            return $invoice->update(array_filter($request->all()))
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Tagihan Berhasil Disimpan',
                    'statusCode' => 200,
                    'result' => new InvoiceResource($invoice)
                ]) : throw new Exception('Data Tagihan Gagal Disimpan');
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ]);
        }
    }

    public function destroy(Invoice $invoice)
    {
        try {
            return $invoice->delete()
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Tagihan Berhasil Dihapus',
                    'statusCode' => 200,
                    'result' => new InvoiceResource($invoice)
                ]) : throw new Exception('Data Tagihan Gagal Dihapus');
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ]);
        }
    }
}
