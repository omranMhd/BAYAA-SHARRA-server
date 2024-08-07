<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'firstName' => ['required', 'max:10'],
            'lastName' => ['required', 'max:10'],
            'email' => ['required', 'email', 'unique:users,email'],
            // 'email' => ['required_without:phone', 'email', 'unique:users,email'],
            // 'phone' => ['required_without:email', 'unique:users,phone'],
            'password' => ['required', 'min:8'],
            'address' => ['required'],
        ];
    }
}
