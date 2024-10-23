<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
            'first_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'other_name' => 'nullable|string',
            'gender' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'marital_status' => 'nullable|string',
            'nia_number' => 'nullable|string',
            'telephone_number' => 'nullable|string',
            'country_of_citizenship' => 'nullable|string',
            'customer_type' => 'nullable|string|exists:customer_types,id',
            'status' => 'nullable|string',
            'Ghana_card_number' => 'nullable|string'
        ];
    }
}
