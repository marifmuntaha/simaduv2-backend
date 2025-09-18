<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateTeacherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return in_array($this->user()->role, ['1', '2']) || $this->user()->id == $this->input('id');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'userId' => 'required|exists:users,id',
            'institution' => 'array',
            'name' => 'required|string',
            'pegId' => 'required|string',
            'birthplace' => 'required|string',
            'birthdate' => 'required|date',
            'gender' => 'required|string',
            'frontTitle' => 'nullable|string',
            'backTitle' => 'nullable|string',
            'phone' => 'required|string',
            'email' => 'required|string',
            'address' => 'required|string',
        ];
    }

    public function attributes(): array
    {
        return [
            'userId' => 'ID Pengguna',
            'institution' => 'ID Lembaga',
            'name' => 'Nama Guru',
            'pageID' => 'PageID',
            'birthplace' => "Tempat Lahir",
            'birthdate' => 'Tanggal Lahir',
            'gender' => 'Jenis Kelamin',
            'frontTitle' => 'Gelar Depan',
            'backTitle' => 'Gelar Belakang',
            'phone' => 'Nomor HP',
            'email' => 'Email',
            'address' => 'Alamat',
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
