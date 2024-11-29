<?php

namespace App\Http\Requests\API\Customer;

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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'prefix' => 'required|string',
            'gender' => 'required|string|in:Male,Female',
            'date_of_birth' => 'required|date|date_format:Y-m-d',
            'marital_status' => 'required|string|in:Single,Married,Divorced',
            'telephone_number' => 'required|string|digits:10',
            'country_of_citizenship' => 'required|string|in:Ghana,Nigeria,Togo',
            'customer_type' => 'required|string|exists:customer_types,id',
            'Ghana_card_number' => 'nullable|string'
        ];
    }
}
