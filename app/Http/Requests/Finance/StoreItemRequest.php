<?php

namespace App\Http\Requests\Finance;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreItemRequest extends FormRequest
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
            'yearId' => 'required|integer|exists:years,id',
            'institutionId' => 'required|integer|exists:institutions,id',
            'programId' => 'required',
            'accountId' => 'required|integer|exists:accounts,id',
            'name' => 'required|string',
            'alias' => 'required|string',
            'gender' => 'required|string',
            'boardingId' => 'required',
            'repeat' => 'required',
            'price' => 'required',
        ];
    }

    public function attributes(): array
    {
        return [
            'yearId' => 'ID Tahun Pelajaran',
            'institutionId' => 'ID Lembaga',
            'programId' => 'ID Program',
            'accountId' => 'ID Rekening',
            'name' => 'Nama',
            'alias' => 'Alias',
            'gender' => 'Jenis Kelamin',
            'boardingId' => 'Boarding',
            'repeat' => 'Bulanan',
            'price' => 'Harga',
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
