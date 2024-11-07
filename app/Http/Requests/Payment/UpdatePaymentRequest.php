<?php

namespace App\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Payment;
class UpdatePaymentRequest extends FormRequest
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
        $payment = Payment::findOrFail($this->route("id"));
        return [
            'appointmentId' => 'required_without:operationId',
            'operationId' => 'required_without:appointmentId',
            'totalAmount' => 'required',
            'firstAmount' => 'required',
            'remainingAmount' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [

            'appointmentId.required' => 'The appointment ID is required.',
            'appointmentId.integer' => 'The appointment ID must be a valid integer.',
            'appointmentId.min' => 'The appointment ID cannot be less than 1.',
            'appointmentId.max' => 'The appointment ID cannot be greater than 9,223,372,036,854,775,807.',

            'operationId.required' => 'The operation ID is required.',
            'operationId.integer' => 'The operation ID must be a valid integer.',
            'operationId.min' => 'The operation ID cannot be less than 1.',
            'operationId.max' => 'The operation ID cannot be greater than 9,223,372,036,854,775,807.',
        ];
    }
}
