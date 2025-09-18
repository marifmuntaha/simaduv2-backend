<?php

namespace App\Http\Requests\Student;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateAddressRequest extends FormRequest
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
            'provinceId' => 'required|integer',
            'cityId' => 'required|integer',
            'districtId' => 'required|integer',
            'villageId' => 'required|integer',
            'address' => 'required|string'
        ];
    }

    public function attributes(): array
    {
        return [
            'studentId' => 'required|integer|exists:students,id',
            'provinceId' => 'required|integer',
            'cityId' => 'required|integer',
            'districtId' => 'required|integer',
            'villageId' => 'required|integer',
            'address' => 'required|string'
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
