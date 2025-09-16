<?php

namespace App\Http\Requests\Student;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMutationRequest extends FormRequest
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
            'yearId' => 'required|integer|exists:years,id',
            'institutionId' => 'required|integer|exists:institutions,id',
            'type' => 'required|string',
            'numberLetter' => 'required|string',
            'studentId' => 'required|exists:students,id',
            'description' => 'nullable|string',
            'schoolNPSN' => 'nullable|string',
            'schoolName' => 'nullable|string',
            'schoolAddress' => 'nullable|string',
            'operatorName' => 'nullable|string',
            'operatorPhone' => 'nullable|string',
            'letterEmis' => 'required|file|mimes:pdf|max:2048',
        ];
    }

    public function attributes(): array
    {
        return [
            'yearId' => 'ID Tahun',
            'institutionId' => 'ID Lembaga',
            'type' => 'required|string',
            'numberLetter' => 'Nomor Surat',
            'studentId' => 'ID Siswa',
            'description' => 'Diskripsi',
            'schoolNPSN' => 'NPSN Sekolah Tujuan',
            'schoolName' => 'Nama Sekolah Tujuan',
            'schoolAddress' => 'Alamat Sekolah Tujuan',
            'operatorName' => 'Nama Operator',
            'operatorPhone' => 'Nomor HP Operator',
            'letterEmis' => 'Surat EMIS',
            'status' => 'Status',
        ];
    }
}
