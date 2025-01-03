<?php

namespace App\Http\Requests\Division;

use Illuminate\Foundation\Http\FormRequest;

class CreateDivisionRequest extends FormRequest
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
            'division_code' => ['required', 'string', 'unique:divisions,division_code'],
            'division_name' => ['required', 'string'],
            'assembly_code' => ['required', 'string', 'exists:assemblies,assembly_code'],
            'status' => ['required', 'string']
        ];
    }
}
