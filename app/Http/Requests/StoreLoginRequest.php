<?php

namespace App\Http\Requests;

use App\Rules\Recaptha;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreLoginRequest extends FormRequest
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
            'username' => 'required|string',
            'password' => 'required|string',
            'g-recaptcha-response' => ['required', 'string', new Recaptha]
        ];
    }

    public function attributes(): array
    {
        return [
            'username' => 'Nama Pengguna',
            'password' => 'Kata Sandi',
            'g-recaptcha-response' => 'Recaptcha',
        ];
    }
}
