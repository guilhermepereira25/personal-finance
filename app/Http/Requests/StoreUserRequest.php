<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_name' => 'required',
            'user_email' => 'required',
            'user_password' => 'required|min:8'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     * 
     */
    public function messages(): array
    {
        return [
            'user_name.required' => 'User name is required',
            'user_email.required' => 'User email is required',
            'user_password.required' => 'User password is required',
            'user_password.min' => 'User password must be at least 8 characters'
        ];
    }
}
