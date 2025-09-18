<?php

namespace App\Http\Requests\Master;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class StoreLadderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->role == '1';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'alias' => 'required|string',
            'description' => 'nullable|string',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Nama Jenjang',
            'alias' => 'Nama Singkatan',
            'description' => 'Diskripsi',
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
