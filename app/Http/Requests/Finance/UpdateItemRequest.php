<?php

namespace App\Http\Requests\Finance;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateItemRequest extends FormRequest
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
            'id' => 'required|exists:items,id',
            'institutionId' => 'required|integer|exists:institutions,id',
            'accountAppId' => 'required|integer|exists:accounts,id',
            'accountRevId' => 'required|integer|exists:accounts,id',
            'name' => 'required|string',
            'alias' => 'required|string',
            'repeat' => 'required',
        ];
    }

    public function attributes(): array
    {
        return [
            'institutionId' => 'ID Lembaga',
            'accountAppId' => 'Rekening Perkiraan',
            'accountRevId' => 'Rekening Pendapatan',
            'name' => 'Nama',
            'alias' => 'Alias',
            'repeat' => 'Bulanan',
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
