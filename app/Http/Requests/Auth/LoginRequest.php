<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ];
    }

    /**
     * Get the custom validation messages.
     */
    public function messages(): array
    {
        return [
            'email.required' => 'Masukkan email! cth:user@gmail.com',
            'email.email' => 'Format email tidak valid, cth:user@gmail.com',
            'email.unique' => 'Email sudah terdaftar, gunakan email lain',

            'password.required' => 'Password harus 6 karakter',
            'password.min' => 'Password harus 6 karakter',
            // 'password.confirmed' => 'Konfirmasi password tidak cocok',
        ];
    }
}