<?php

namespace App\Http\Requests\Master;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateLevelRequest extends FormRequest
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
            'ladderId' => 'required|exists:ladders,id',
            'name' => 'required|string',
            'alias' => 'required|string',
            'description' => 'nullable|string',
        ];
    }

    public function attributes(): array
    {
        return [
            'ladderId' => 'ID Jenjang',
            'name' => 'Nama Tingkat',
            'alias' => 'Nama Alias',
            'description' => 'Diskripsi',
        ];
    }
}
