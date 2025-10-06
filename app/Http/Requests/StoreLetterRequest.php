<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreLetterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'number' => 'nullable|string',
            'type' => 'required',
            'data' => 'nullable|string',
            'signature' => 'nullable|string',
        ];
    }

    public function attributes(): array
    {
        return [
            'number' => 'Nomor',
            'type' => 'Jenis',
            'data' => 'Data',
            'signature' => 'Keterangan',
        ];

    }
}
