<?php

namespace App\Http\Requests\Institution;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRombelRequest extends FormRequest
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
            'yearId' => 'required|integer|exists:years,id',
            'institutionId' => 'required|integer|exists:institutions,id',
            'levelId' => 'required|integer|exists:levels,id',
            'majorId' => 'required|integer|exists:majors,id',
            'name' => 'required|string|max:255',
            'alias' => 'required|string|max:255',
            'teacherId' => 'required|integer|exists:teachers,id',
        ];
    }

    public function attributes(): array
    {
        return [
            'yearId' => 'ID Tahun Pelajaran',
            'institutionId' => 'ID Lembaga',
            'levelId' => 'ID Tingkat',
            'majorId' => 'ID Jurusan',
            'name' => 'Nama Rombel',
            'alias' => 'Alias',
            'teacherId' => 'ID Guru Walikelas',
        ];
    }
}
