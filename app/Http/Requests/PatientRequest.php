<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return $this->isMethod( 'POST' ) ? $this->store() : $this->update();

    }

    /**
     * validation rules for storing a patient
     * @return string[]
     */
    public function store(): array
    {
        return [
            'first_name'    => 'required|alpha',
            'last_name'     => 'required|alpha',
            'id_number'     => 'required|alpha_num|min:8|max:15|unique:patients,id_number',
            'dob'           => 'required|date',
            'address'       => 'required',
            'gender'        => 'required|in:Female,Male'
        ];

    }

    /**
     * validation rules for updating patient
     * @return string[]
     */
    public function update(): array
    {
        return [
            'first_name'    => 'required|alpha',
            'last_name'     => 'required|alpha',
            'id_number'     => 'required|alpha_num|min:8|max:15|unique:patients,id_number,' . $this->id,
            'dob'           => 'required|date',
            'address'       => 'required',
            'gender'        => 'required|in:Female,Male'
        ];

    }

    /**
     * validation error messages
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'first_name.required'   => 'Enter patient\'s first name',
            'last_name.required'    => 'Enter patient\'s last name',
            'id_number.required'    => 'Enter patient\'s national id number',
            'id_number.alpha_num'   => 'Patient\'s national id number must have alpha numeric characters only',
            'id_number.min'         => 'Patient\'s national id number must have a minimum of eight(8) alpha numeric characters',
            'id_number.max'         => 'Patient\'s national id number must have a maximum of eight(15) alpha numeric characters',
            'id_number.unique'      => 'National id number already registered',
            'dob.required'          => 'Patient\'s date of birth is required',
            'dob.date'              => 'Patient\'s date of birth is not valid',
            'gender.required'       => 'Patient\'s gender is required',
            'gender.in'             => 'Patient\'s gender must be either Female or Male',
            'address.required'      => 'Patient\'s address is required'
        ];

    }

}
