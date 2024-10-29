<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\models\Patient;
class UpdatePatientRequest extends FormRequest
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

        $patientId=Patient::find($this->route('id'));

        // dd($patientId->idNumber);
        // dd('ss');
        return [
            'firstName'=>'nullable|string|max:30',
            'lastName'=>'nullable|string|max:30',
            'idNumber'=>'nullable|string|unique:patients,idNumber,'.$patientId->idNumber,
            'bloodType' =>'nullable|string',
            'gender'=>'nullable|string',
            'address'=>'nullable|string',
            'phone'=>'nullable|string',
            'dob'=>'nullable|date',
            ];

    }

}
