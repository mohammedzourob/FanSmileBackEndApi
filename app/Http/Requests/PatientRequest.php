<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules()
    {
        // dd('ss');
        return [
        'firstName'=>'required|string|max:30',
        'lastName'=>'required|string|max:30',
        'idNumber'=>'required|string|unique:patients',
        'bloodType' =>'required|string',
        'gender'=>'required|string',
        'address'=>'required|string',
        'phone'=>'required|string',
        'dob'=>'required|date',
        ];
    }
    public function messages()
    {

    return [
        'idNumber' => 'The id Number is alerte another User',
        'phone.required' => 'The phone is required ',
    ];
}

}
