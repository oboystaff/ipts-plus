<?php

namespace App\Http\Requests\API\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|confirmed',
            'phone' => 'required|string|max:15',
            'access_level' => 'required|string|in:Assembly_Supervisor,Assembly_Agent,customer',
            'assembly_code' => 'required|string|exists:assemblies,assembly_code',
            'division_code' => 'required|string|exists:divisions,division_code',
            'status' => 'nullable|string'
        ];
    }
}
