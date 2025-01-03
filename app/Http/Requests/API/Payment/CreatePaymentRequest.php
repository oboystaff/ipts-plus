<?php

namespace App\Http\Requests\API\Payment;

use Illuminate\Foundation\Http\FormRequest;

class CreatePaymentRequest extends FormRequest
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
            'bills_id' => ['required', 'string', 'exists:bills,bills_id'],
            'payment_mode' => ['required', 'string', 'in:momo'],
            'amount' => ['required', 'numeric'],
            'phone' => ['required', 'string'],
            'network' => ['required', 'string', 'in:MTN,AIRTELTIGO,VODAFONE'],
            'assembly_code' => ['required', 'string', 'exists:assemblies,assembly_code']
        ];
    }
}
