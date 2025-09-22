<?php

namespace App\Http\Requests\Finance;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreInvoiceRequest extends FormRequest
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
            'institutionId' => ['required', 'integer', 'exists:institutions,id'],
            'itemId' => ['required', 'integer', 'exists:items,id'],
            'studentId' => ['required', 'integer', 'exists:students,id'],
            'number' => ['nullable', 'string'],
            'name' => ['required', 'string'],
            'amount' => ['required', 'numeric'],
            'status' => ['nullable', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'institutionId' => 'ID Lembaga',
            'itemId' => 'ID Item',
            'studentId' => 'ID Siswa',
            'number' => 'Nomor Tagihan',
            'name' => 'Keterangan',
            'amount' => 'Jumlah Tagihan',
            'status' => 'Status Tagihan',
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
