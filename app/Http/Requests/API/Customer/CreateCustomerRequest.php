<?php

namespace App\Http\Requests\API\Customer;

use Illuminate\Foundation\Http\FormRequest;

class CreateCustomerRequest extends FormRequest
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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'prefix' => 'nullable|string',
            'gender' => 'nullable|string|in:Male,Female',
            'date_of_birth' => 'nullable|date|date_format:Y-m-d|before:today',
            'marital_status' => 'nullable|string|in:Single,Married,Divorced,Widowed',
            'telephone_number' => 'required|string|digits:10|unique:citizens,telephone_number',
            'country_of_citizenship' => 'required|string|in:Ghana,Nigeria,Togo',
            'customer_type' => 'required|string|exists:customer_types,id',
            'Ghana_card_number' => 'nullable|string|unique:citizens'
        ];
    }
}
