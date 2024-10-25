<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|confirmed',
            'phone' => 'required|string|max:15|unique:users,phone',
            'access_level' => 'required|string',
            'status' => 'required|string',
            'assembly_code' => 'required_if:access_level,Assembly_Supervisor|nullable|string',
            'division_code' => 'required_if:access_level,Assembly_Supervisor|nullable|string',
            'role' => 'required|string'
        ];
    }
}
