<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            'userId' => 'required|integer|exists:users,id',
            'nik' => 'required|string|size:16',
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
            'nik' => 'NIK Anak',
            'nama' => 'Nama Lengkap',
            'gender' => 'Jenis Kelamin',
            'birthplace' => 'Tempat Lahir',
            'birthdate' => 'Tanggal Lahir',
            'email' => 'Email',
            'phone' => 'Nomor HP',
        ];
    }
}
