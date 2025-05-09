<?php

namespace App\Http\Requests\User;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $user = $this->route('user');

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|confirmed',
            'phone' => 'required|string|max:15|unique:users,phone,' . $user->id,
            'access_level' => 'required|string',
            'status' => 'required|string',
            'regional_code' => 'nullable|string|exists:ghana_regions,regional_code',
            'assembly_code' => 'nullable|string|string|exists:assemblies,assembly_code',
            'division_code' => 'nullable|string|string|exists:divisions,division_code',
            'role' => 'required|string',
            'gender' => 'nullable|string'
        ];
    }
}
