<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserInfoRequest extends FormRequest
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
        $rules = [
            'email' => ['email']
            // Other fields validation rules...
        ];

        // Check if 'name' is present, if so, add the email validation rule
        if ($this->input('email')) {
            $rules['verificationCode'] = ['required'];
        } else {
            // Optionally, remove the email rule if not needed when 'name' is absent
            unset($rules['verificationCode']);
        }

        return $rules;

        // return [
        //     'email' => ['email']
        // ];
    }
}
