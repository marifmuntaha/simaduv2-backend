<?php

namespace App\Http\Requests\Student;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed $id
 */
class UpdateParentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return in_array($this->user()->role, [1, 2, 5, 6]) || $this->user()->id == $this->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'numberKk' => 'nullable|string',
            'headFamily' => 'nullable|string',
            'fatherName' => 'nullable|string',
            'fatherNIK' => 'nullable|string',
            'fatherStatus' => 'nullable|string',
            'fatherBirthplace' => 'nullable|string',
            'fatherBirthdate' => 'nullable|date',
            'fatherEmail' => 'nullable|string',
            'fatherPhone' => 'nullable|string',
            'motherName' => 'nullable|string',
            'motherNIK' => 'nullable|string',
            'motherStatus' => 'nullable|string',
            'motherBirthplace' => 'nullable|string',
            'motherBirthdate' => 'nullable|date',
            'motherEmail' => 'nullable|string',
            'motherPhone' => 'nullable|string',
            'guardStatus' => 'nullable|string',
            'guardName' => 'nullable|string',
            'guardNIK' => 'nullable|string',
            'guardBirthplace' => 'nullable|string',
            'guardBirthdate' => 'nullable|date',
            'guardEmail' => 'nullable|string',
            'guardPhone' => 'nullable|string',
        ];
    }

    public function attributes(): array
    {
        return [
            'numberKk' => 'Nomor Kartu Keluarga',
            'headFamily' => 'Kepala Keluarga',
            'fatherName' => 'Nama Ayah',
            'fatherNIK' => 'NIK Ayah',
            'fatherStatus' => 'Status Ayah',
            'fatherBirthplace' => 'Tempat Lahir Ayah',
            'fatherBirthdate' => 'Tanggal Lahir Ayah',
            'fatherEmail' => 'Alamat Email Ayah',
            'fatherPhone' => 'Nomor HP Ayah',
            'motherName' => 'Nama Ibu',
            'motherNIK' => 'NIK Ibu',
            'motherStatus' => 'Status Ibu',
            'motherBirthplace' => 'Tempat Lahir Ibu',
            'motherBirthdate' => 'Tanggal Lahir Ibu',
            'motherEmail' => 'Alamat Email Ibu',
            'motherPhone' => 'Nomor HP Ibu',
            'guardStatus' => 'Status Wali',
            'guardName' => 'Nama Wali',
            'guardNIK' => 'NIK Wali',
            'guardBirthplace' => 'Tempat Lahir Wali',
            'guardBirthdate' => 'Tanggal Lahir Wali',
            'guardEmail' => 'Alamat Email Wali',
            'guardPhone' => 'Nomor HP Wali',
        ];
    }
}
