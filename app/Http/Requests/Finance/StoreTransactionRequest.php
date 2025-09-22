<?php

namespace App\Http\Requests\Finance;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'institutionId' => 'required|exists:institutions,id',
            'accountAppId' => 'nullable',
            'accountRevId' => 'required|exists:accounts,id',
            'code' => 'required|string',
            'number' => 'nullable|string',
            'name' => 'required|string',
            'amount' => 'required|string',
        ];
    }

    public function attributes(): array
    {
        return [
            'institutionId' => 'ID Lembaga',
            'accountAppId' => 'Rekening Perkiraan',
            'accountRevId' => 'Rekening Pendapatan',
            'code' => 'Kode Transaksi',
            'number' => 'Nomor Transaksi',
            'name' => 'Keterangan Transaksi',
            'amount' => 'Jumlah Transaksi',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'statusMessage' => $validator->errors()->first(),
            'statusCode' => 422,
        ], 422));
    }
}
