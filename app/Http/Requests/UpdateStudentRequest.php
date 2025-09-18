<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return in_array($this->user()->role, [1, 2, 3]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nik' => 'required|string|exists:students,nik',
            'nisn' => 'required|string',
            'nism' => 'required|string',
            'name' => 'required|string',
            'gender' => 'required|string',
            'birthplace' => 'required|string',
            'birthdate' => 'required|date',
            'email' => 'required|email',
            'phone' => 'required|string',
        ];
    }

    public function attributes(): array
    {
        return [
            'userId' => 'ID Pengguna',
            'nisn' => 'NISN',
            'nism' => 'NISM',
            'nama' => 'Nama Lengkap',
            'gender' => 'Jenis Kelamin',
            'birthplace' => 'Tempat Lahir',
            'birthdate' => 'Tanggal Lahir',
            'email' => 'Email',
            'phone' => 'Nomor HP',
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
