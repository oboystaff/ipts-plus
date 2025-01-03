<?php

namespace App\Http\Requests\Block;

use Illuminate\Foundation\Http\FormRequest;

class CreateBlockRequest extends FormRequest
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
            'block_code' => 'required|unique:blocks,block_code',
            'block_name' => 'required|string',
            'assembly_code' => 'required|string|exists:assemblies,assembly_code',
            'division_code' => 'required|string|exists:divisions,id'
        ];
    }
}
