<?php

namespace App\Http\Requests\Business;

use Illuminate\Foundation\Http\FormRequest;

class CreateBusinessRequest extends FormRequest
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
            'business_name' => 'required|string',
            'business_type' => 'required|string',
            'business_class' => 'required|string',
            'location' => 'required|string',
            'email' => 'nullable|email',
            'street_name' => 'nullable|string',
            'digital_address' => 'nullable|string',
            'house_number' => 'nullable|string',
            'business_phone' => 'required|string|max:15',
            'permit_number' => 'nullable|string',
            'business_validation_code' => 'nullable|string',
            'registration_number' => 'nullable|string',
            'business_address' => 'nullable|string',
            'business_contact' => 'nullable|string',
            'nature_of_business' => 'nullable|string',
            'tax_identification_number' => 'nullable|string',
            'establishment_date' => 'nullable|date',
            'citizen_account_number' => 'required|string',
            'bus_account_number' => 'nullable|string',
            'assembly_code' => 'required|string|exists:assemblies,assembly_code',
            'division_id' => 'required|exists:divisions,id',
            'block_id' => 'required|exists:blocks,id',
            'zone_id' => 'required|exists:zones,id',
            'property_use_id' => 'required|exists:property_users,id',
            'status_of_business' => 'nullable|string'
        ];
    }
}
