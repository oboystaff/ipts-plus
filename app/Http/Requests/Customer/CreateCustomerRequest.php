<?php

namespace App\Http\Requests\Customer;

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
            'other_name' => 'nullable|string',
            'gender' => 'required|string',
            'date_of_birth' => 'required|date',
            'marital_status' => 'required|string',
            'nia_number' => 'required|string|unique:citizens,nia_number',
            'telephone_number' => 'required|string|unique:citizens,telephone_number',
            'country_of_citizenship' => 'required|string',
            'customer_type' => 'required|string|exists:customer_types,id',
            'Ghana_card_number' => 'required|string|unique:citizens',
            'status' => 'required|string'
        ];
    }
}
