<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminInfoRequest extends FormRequest
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
            'firstName' => ['max:10'],
            'lastName' => ['max:10'],
            'email' => ['email', 'unique:users,email'],
            // 'email' => ['required_without:phone', 'email', 'unique:users,email'],
            // 'phone' => ['required_without:email', 'unique:users,phone'],
            'password' => ['required', 'min:8'],
            // 'address' => ['required'],
        ];
    }
}
