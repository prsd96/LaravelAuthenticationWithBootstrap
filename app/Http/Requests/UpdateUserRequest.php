<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string', 'max:255'],
            'role_id' => ['required', 'integer', 'exists:roles,id'],
        ];
    }
    
    // Error messages for above validations
    public function messages()
    {
        return [
            'first_name.required' => 'Please enter your first name.',
            'last_name.required' => 'Please enter your last name.',
            'contact.required' => 'Contact field is required.',
            'role_id.required' => 'Role is required.',
            'role_id.integer' => 'Role must be an integer.',
            'role_id.exists' => 'Selected role does not exist.',
        ];
    }
}
