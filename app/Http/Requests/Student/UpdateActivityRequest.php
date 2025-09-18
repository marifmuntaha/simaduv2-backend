<?php

namespace App\Http\Requests\Student;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateActivityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return in_array($this->user()->role, [1, 2]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'status' => 'required',
            'yearId' => 'required',
            'institutionId' => 'required',
            'rombelId' => 'nullable',
            'programId' => 'nullable',
            'boardingId' => 'nullable',
        ];
    }
    public function attributes(): array
    {
        return [
            'studentId' => 'ID Siswa',
            'status' => 'Status',
            'yearId' => 'ID Tahun Pelajaran',
            'institutionId' => 'ID Lembaga',
            'rombelId' => 'ID Rombel',
            'programId' => 'ID Program',
            'boardingId' => 'ID Boarding',
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
