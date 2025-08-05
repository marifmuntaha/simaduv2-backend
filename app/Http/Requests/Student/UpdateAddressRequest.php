<?php

namespace App\Http\Requests\Student;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressRequest extends FormRequest
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
            'studentId' => 'required|integer|exists:students,id',
            'provinceId' => 'required|integer',
            'cityId' => 'required|integer',
            'districtId' => 'required|integer',
            'villageId' => 'required|integer',
            'address' => 'required|string'
        ];
    }

    public function attributes(): array
    {
        return [
            'studentId' => 'required|integer|exists:students,id',
            'provinceId' => 'required|integer',
            'cityId' => 'required|integer',
            'districtId' => 'required|integer',
            'villageId' => 'required|integer',
            'address' => 'required|string'
        ];
    }
}
