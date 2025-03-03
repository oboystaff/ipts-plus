<?php

namespace App\Http\Requests\BusinessClassType;

use Illuminate\Foundation\Http\FormRequest;

class CreateBusinessClassTypeRequest extends FormRequest
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
            'name' => 'required|string',
            'category' => 'required|string',
            'rate' => 'required|numeric',
            'identifier' => 'required|string',
            'extra_class_identifier' => 'required|string'
        ];
    }
}
