<?php

namespace App\Http\Requests\appointment;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppointmentRequest extends FormRequest
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
            'userId'=>'required|integer|min:1|max:9223372036854775807',
            'patientId'=>'required|integer|min:1|max:9223372036854775807',
            'startDate'=>['nullable', 'date', 'after_or_equal:today'],
            'endDate' => ['nullable', 'date', 'after_or_equal:today'],
            'details'=>'nullable'
        ];
    }

    public function messages(): array
    {
        return[
            'userId.required' => 'The user ID is required.',
            'userId.integer' => 'The user ID must be a valid integer.',
            'userId.min' => 'The user ID cannot be less than 1',
            'userId.max' => 'The user ID cannot be greater than 9,223,372,036,854,775,807.',

            'patientId.required' => 'The patient ID is required.',
            'patientId.integer' => 'The patient ID must be a valid integer.',
            'patientId.min' => 'The patient ID cannot be less than 1.',
            'patientId.max' => 'The patient ID cannot be greater than 9,223,372,036,854,775,807.',
        ];
    }
}