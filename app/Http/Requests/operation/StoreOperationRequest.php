<?php

namespace App\Http\Requests\operation;

use Illuminate\Foundation\Http\FormRequest;

class StoreOperationRequest extends FormRequest
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
            'userId'=>'required',
            'patientId'=>'required',
            'date'=>['required', 'date', 'after_or_equal:today','date_format:Y-m-d H:i:s'],
            'details'=>'required',
            'photo'=>'nullable',
            'status'=>'wating'
        ];
    }
    public function messages():array
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

            'date.required' => 'The operation date and time is required.',
            'date.date' => 'The operation date must be a valid date.',
            'date.date_format' => 'The operation date must be in the format YYYY-MM-DD HH:MM:SS.',
            'date.after_or_equal' => 'The operation date cannot be in the past and must be today or a future date.',


        ];
    }

}
