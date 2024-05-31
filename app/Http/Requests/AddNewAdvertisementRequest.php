<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddNewAdvertisementRequest extends FormRequest
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
            'advertisement_user_id' => ['required'],
            'advertisement_address' => ['required'],
            'advertisement_title' => ['required'],
            'advertisement_description' => ['required'],
            'advertisement_contactNumber' => ['required'],
            'advertisement_category' => ['required'],
            'photo_1' => ['mimes:jpeg,jpg,png,gif', 'max:500'],
            'photo_2' => ['mimes:jpeg,jpg,png,gif', 'max:500'],
            'photo_3' => ['mimes:jpeg,jpg,png,gif', 'max:500'],
            'photo_4' => ['mimes:jpeg,jpg,png,gif', 'max:500'],
            'photo_5' => ['mimes:jpeg,jpg,png,gif', 'max:500'],
            'photo_6' => ['mimes:jpeg,jpg,png,gif', 'max:500'],
        ];
    }
}
