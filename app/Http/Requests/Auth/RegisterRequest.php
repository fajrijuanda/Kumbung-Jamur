<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Username harus diisi, unik di tabel users, dan hanya boleh huruf, angka, dash, underscore
            'username' => 'required|string|alpha_dash|max:255|unique:users',
            // Email harus diisi, format email valid, dan unik di tabel users
            'email' => 'required|string|email|max:255|unique:users',
            // Password harus diisi, dikonfirmasi, dan memenuhi standar keamanan
            'password' => ['required', 'confirmed', Password::defaults()],
            // Checkbox 'terms' harus dicentang (accepted)
            'terms' => 'accepted',
        ];
    }

    /**
     * Pesan error kustom untuk validasi.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username ini sudah digunakan.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'terms.accepted' => 'Anda harus menyetujui kebijakan privasi & persyaratan.',
        ];
    }
}
