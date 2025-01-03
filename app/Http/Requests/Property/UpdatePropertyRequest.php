<?php

namespace App\Http\Requests\Property;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePropertyRequest extends FormRequest
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
            'entity_type' => 'nullable|string|exists:business_class_types,id',
            'digital_address' => 'nullable|string',
            'location' => 'nullable|string',
            'street_name' => 'nullable|string',
            'rated' => 'nullable|string',
            'validated' => 'nullable|string',
            'ratable_value' => 'nullable|numeric',
            'customer_name' => 'nullable|string|exists:citizens,id',
            'assembly_code' => 'nullable|string|exists:assemblies,assembly_code',
            'longitude' => 'nullable|string',
            'latitude' => 'nullable|string',
            'division_id' => 'required|string|exists:divisions,id',
            'block_id' => 'required|string|exists:blocks,id',
            'zone_id' => 'required|string|exists:zones,id',
            'property_use_id' => 'required|string|exists:property_users,id'
        ];
    }
}
