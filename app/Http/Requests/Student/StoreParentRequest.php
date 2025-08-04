<?php

namespace App\Http\Requests\Student;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed $fatherStatus
 * @property mixed $motherStatus
 */
class StoreParentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return in_array($this->user()->role, [1, 2, 5, 6]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'numberKk' => 'required|string',
            'headFamily' => 'required|string',
            'fatherStatus' => 'required|string',
            'motherStatus' => 'required|string',
            'guardStatus' => 'required|string',
            'guardName' => 'required|string',
            'guardNIK' => 'required|string',
            'guardBirthplace' => 'required|string',
            'guardBirthdate' => 'required|date',
            'guardEmail' => 'required|string',
            'guardPhone' => 'required|string',
        ];
        if ($this->fatherStatus === 1) {
            $father = array_merge($rules, [
                'fatherName' => 'required|string',
                'fatherNIK' => 'required|string',
                'fatherBirthplace' => 'required|string',
                'fatherBirthdate' => 'required|date',
                'fatherEmail' => 'required|string',
                'fatherPhone' => 'required|string',
            ]);
        } else {
            $father = array_merge($rules, [
                'fatherName' => 'nullable|string',
                'fatherNIK' => 'nullable|string',
                'fatherBirthplace' => 'nullable|string',
                'fatherBirthdate' => 'nullable|date',
                'fatherEmail' => 'nullable|string',
                'fatherPhone' => 'nullable|string',
            ]);
        }
        if ($this->motherStatus == 1) {
            $mother = array_merge($rules, [
                'motherName' => 'required|string',
                'motherNIK' => 'required|string',
                'motherBirthplace' => 'required|string',
                'motherBirthdate' => 'required|date',
                'motherEmail' => 'required|string',
                'motherPhone' => 'required|string',
            ]);
        } else {
            $mother = array_merge($rules, [
                'motherName' => 'nullable|string',
                'motherNIK' => 'nullable|string',
                'motherBirthplace' => 'nullable|string',
                'motherBirthdate' => 'nullable|date',
                'motherEmail' => 'nullable|string',
                'motherPhone' => 'nullable|string',
            ]);
        }
        return array_merge($rules, $father, $mother);
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
