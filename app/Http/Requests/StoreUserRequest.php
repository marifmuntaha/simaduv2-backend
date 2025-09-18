<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return in_array($this->user()->role, ['1', '2']);
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
            'email' => 'required|string|unique:users,email',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string',
            'phone' => 'required|string',
            'role' => 'required|string',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Nama',
            'email' => 'Email',
            'username' => 'Nama Pengguna',
            'password' => 'Kata Sandi',
            'phone' => 'Nomor HP',
            'role' => 'Hak Akses',
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
