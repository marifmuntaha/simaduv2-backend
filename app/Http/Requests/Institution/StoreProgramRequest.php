<?php

namespace App\Http\Requests\Institution;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProgramRequest extends FormRequest
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
            'yearId' => 'required|exists:years,id',
            'institutionId' => 'required|exists:institutions,id',
            'name' => 'required|string',
            'alias' => 'required|string',
        ];
    }

    public function attributes(): array
    {
        return [
            'yearId' => 'ID Tahun Pelajaran',
            'institutionId' => 'ID Lembaga/Instansi',
            'name' => 'Nama Program',
            'alias' => 'Alias',
        ];
    }
}
