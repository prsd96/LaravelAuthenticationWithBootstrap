<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
    }

    // Error messages for above validations
    public function messages()
    {
        return [
            'email.required' => 'Email ID is required.',
            'email.email' => 'Invalid Email ID format.',
            'password.required' => 'Password is required.',
        ];
    }
}
