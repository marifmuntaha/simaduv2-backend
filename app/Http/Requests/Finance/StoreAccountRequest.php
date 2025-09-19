<?php

namespace App\Http\Requests\Finance;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreAccountRequest extends FormRequest
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
            'institutionId' => ['required', 'exists:institutions,id'],
            'codeParent' => ['nullable', 'string'],
            'codeApp' => ['required', 'string', 'unique:accounts,codeApp'],
            'code' => ['required', 'string'],
            'name' => ['required', 'string'],
            'level' => ['required', 'string'],
            'balance' => ['nullable', 'numeric', 'min:0'],
        ];
    }

    public function attributes(): array
    {
        return [
            'institutionId' => 'ID Lembaga',
            'code' => 'Kode Rekening',
            'name' => 'Nama Rekening',
            'level' => 'Level Rekening',
            'balance' => 'Saldo',
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
