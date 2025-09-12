<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateInstitutionRequest extends FormRequest
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
            'ladderId' => 'required|integer|exists:ladders,id',
            'name' => 'required|string',
            'alias' => 'required|string',
            'nsm' => 'required|numeric',
            'npsn' => 'required|numeric',
            'address' => 'required|string',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'website' => 'required|string',
        ];
    }

    public function attributes(): array
    {
        return [
            'ladderId' => 'ID Jenjang',
            'name' => 'Nama Madrasah',
            'alias' => 'Singkatan',
            'nsm' => 'NSM',
            'npsn' => 'NPSN',
            'address' => 'Alamat',
            'phone' => 'Nomor Telepon',
            'email' => 'Email',
            'website' => 'Website',
            'logo' => 'Logo',
        ];
    }
}
