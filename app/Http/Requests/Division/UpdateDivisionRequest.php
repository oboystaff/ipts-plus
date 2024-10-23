<?php

namespace App\Http\Requests\Division;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDivisionRequest extends FormRequest
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
            'division_code' => ['nullable', 'string'],
            'division_name' => ['nullable', 'string'],
            'assembly_code' => ['nullable', 'string', 'exists:assemblies,assembly_code'],
            'status' => ['nullable', 'string']
        ];
    }
}
