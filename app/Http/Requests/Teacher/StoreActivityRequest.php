<?php

namespace App\Http\Requests\Teacher;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreActivityRequest extends FormRequest
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
            'yearId' => 'required|exists:master_years,id',
            'institutionId' => 'required|exists:institutions,id',
            'teacherId' => 'required|exists:teachers,id',
            'statusCode' => 'required|integer',
            'status' => 'required|boolean',
        ];
    }

    public function attributes(): array
    {
        return [
            'yearId' => 'ID Tahun Pelajaran',
            'institutionId' => 'ID Lembaga',
            'teacherId' => 'ID Guru',
            'statusCode' => 'Jabatan',
            'status' => 'Status',
        ];
    }
}
