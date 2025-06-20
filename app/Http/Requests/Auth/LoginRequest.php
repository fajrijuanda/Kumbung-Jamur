<?php

namespace App\Http\Requests\Auth;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'email-username' => 'required|string',
            'password' => 'required|string',
            'remember' => 'boolean',
        ];
    }
    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'email-username.required' => 'Email or Username is required.',
            'email-username.string' => 'Email or Username must be a string.',
            'password.required' => 'Password is required.',
            'password.string' => 'Password must be a string.',
            'remember.boolean' => 'Remember me must be a boolean value.',
        ];  
    }
}
