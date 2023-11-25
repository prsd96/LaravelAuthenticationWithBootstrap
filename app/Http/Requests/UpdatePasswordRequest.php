<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
            // 'email' => 'email|exists:users',
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->letters()->numbers()->symbols()],
            // 'password_confirmation' => 'required'
        ];
    }
    
    //error messages for above validations
    public function messages()
    {
        return [
            // 'email' => 'email',
            'password' => 'password',
            // 'password_confirmation' => 'password_confirmation',
        ];
    }
}
