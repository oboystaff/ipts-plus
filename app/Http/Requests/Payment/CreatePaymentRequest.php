<?php

namespace App\Http\Requests\Payment;

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
            'payment_mode' => ['required', 'string'],
            'amount' => ['required', 'numeric'],
            'phone' => ['required_if:payment_mode,momo', 'nullable', 'string'],
            'network' => ['required_if:payment_mode,momo', 'nullable', 'string', 'in:MTN,TGO,VDF'],
        ];
    }
}
