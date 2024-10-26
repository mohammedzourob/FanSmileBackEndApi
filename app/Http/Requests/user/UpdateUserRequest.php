<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'nullable|string|max:255|unique:users,name'.auth()->user()->name,
            'email' => 'nullable|email|unique:users,email,' . auth()->user()->email, // Exclude the current user's email from unique check
            'password' => 'nullable|string|min:8|confirmed',
            'idNumber'=> 'nullable',
            'idPersonal'=> 'nullable',
            'description'=> 'nullable|string|max:255',
            'specialization'=> 'nullable|string|max:255',
            'dob'=> 'nullable|date',
            'gender'=> 'nullable|string|max:255',
            'phone'=> 'nullable',
            'address'=> 'nullable|string|max:255',
            'experience'=> 'nullable|integer|max:255',
            'photo'=> 'nullable|string|max:255',
        ];
    }
}
